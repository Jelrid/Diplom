import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import { useForm } from "@inertiajs/react";
import * as React from 'react';

import TextField from '@mui/material/TextField';
import Autocomplete from '@mui/material/Autocomplete';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { AdapterDayjs } from '@mui/x-date-pickers/AdapterDayjs';

import { DateCalendar } from '@mui/x-date-pickers/DateCalendar';
import { createTheme, ThemeProvider } from '@mui/material/styles';

import { ruRU as coreruRU } from '@mui/material/locale';
import { ruRU } from '@mui/x-date-pickers/locales';
import * as dayjs from 'dayjs'

import updateLocale from 'dayjs/plugin/updateLocale';
import { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import Button from '@mui/material/Button';
import InputError from '@/Components/InputError';
import { useEffect } from 'react';



export default function CreateExam({ auth, methods, methodology, workTime, EnableDate }) {
    dayjs.extend(updateLocale);
    dayjs.updateLocale('en', {
        // Sunday = 0, Monday = 1.
        weekStart: 1,
    });


    const theme = createTheme(
        {
            components: {
                MuiPickersDay: {
                    styleOverrides: {
                        root: {
                            color: 'black',
                            borderRadius: '8px',
                            borderWidth: '1px',
                            borderColor: '#2196f3',
                            border: '1px solid',
                            backgroundColor: 'white',
                            localization: 'ru'
                        }
                    }
                }
            },
        },
        ruRU,
        coreruRU
    );


    console.log(EnableDate)

    const { data, setData, post, reset, processing, errors } = useForm({
        methoData: null,
        methodologyData: null,
        employeeData: null,
        dayData: null,
        date: dayjs(),
        time: null,
    });
    const today = dayjs();
    const todayFormate = today.format('YYYY-MM-DD');
    console.log(todayFormate)
    const formatingData = data.date.format('YYYY-MM-DD');


    const methodList = methods.map((elem) => ({ label: elem.name, id: elem.method_id }));

    const methodologyList = methodology.filter((elem) => elem.method_id === data.methoData).map((elem) => ({ label: elem.name, id: elem.methodology_id }));

    const EmployerList = (methodology.find((elem) => elem.methodology_id === data.methodologyData) || { employees: [] }).employees
        .map((elem) => ({ label: ` ${elem.last_name} ${elem.first_name} ${elem.fathers_name}`, id: elem.employee_id }));



    const getDates = () => {
        axios.get('http://127.0.0.1:8001/api/employeeSchedule', {
            employee: data.employee_id,
            timeStart: data.time_start,
            timeEnd: data.time_end,
        }).then((response) => {
            setWorkTimes(response.data.data)
        }).catch((err) => { console.log(err) });
    };



    const onSubmitButton = (e) => {
        e.preventDefault();

        post(route('store.create'), {
            onSuccess: () => {
                // Обработка успешного сохранения
            }, onError: (error) => {
                // Обновляем состояние ошибок
                setError(error);
            }
        });
    };

    const [WorkTimes, setWorkTimes] = useState([])


    const parseWorkTime = () => {
        const elem = WorkTimes.find((elem) => elem.employee_id === data.employeeData);
        const timeSeans = methodology.find((elem) => elem.methodology_id === data.methodologyData)
        let rows = [];
        if (elem) {
            const timeStart = dayjs(formatingData + elem.time_start)
            const timeEnd = dayjs(formatingData + elem.time_end)

            for (let time = timeStart; time.isBefore(timeEnd); time = time.add(timeSeans.time, 'minute')) {

                const timeString = time.format('HH:mm');
                const exists = workTime.some(e => {
                    const existTime = dayjs(e.date + e.time_start);
                    return existTime.isSame(time);
                });

                if (!exists) {
                    rows.push(timeString);
                }
            }
        }
        return rows;
    }

    const timeClasses = (elem) => {
        if (elem === data.time) {
            return 'p-2 rounded-full bg-green-500 hover:bg-green-500 cursor-pointer';
        } else {
            return 'p-2 rounded-full bg-green-300 hover:bg-green-500 cursor-pointer'
        }
    }


    const isDateDisabled = (date) => {
        const dayjsDate = dayjs(date);
        // Проверяем, присутствует ли дата в списке доступных дат
        return dayjsDate.day() === 0;
      };

      const postDateEnable = () =>{

        const dataToSend = {
            'date': todayFormate,
            'methodology': data.methodologyData,
            // 'sid': 'b22ceec1-576a-46ee-8d5d-a61b81d0c8a4'
        }

        axios.post('/api/schedule-colors', dataToSend)
       .then(response => {
            console.log(response.data);
            // Обработка ответа от сервера
        })
       .catch(error => {
            console.error(error);
            // Обработка ошибки
        });
      }

    return (
        <AuthenticatedLayout
            user={auth.user}
        >
            <section>
                <div className="py-12">
                    <div className="max-w-9xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <header className="flex w-auto text-clip">
                                <h2 className="text-lg font-medium text-gray-900 w-1/2">Запись на прием</h2>

                            </header>

                            <Head title="CreateExam" />
                            <form className="mt-6 space-y-6" action={route("store.create")} method='POST' onSubmit={onSubmitButton}>
                                <div className="flex ">

                                    <div>
                                        <InputLabel htmlFor='method' value='Метод обследования' />
                                        <Autocomplete
                                            disablePortal
                                            id="method"
                                            name='method'
                                            options={methodList}
                                            onChange={(e, newValue) => {
                                                setData('methoData', newValue ? newValue.id : null);
                                            }}
                                            isOptionEqualToValue={(option, value) => option.id === value}
                                            className="mt-5 block w-full"
                                            sx={{ width: 300 }}
                                            renderInput={(params) => <TextField {...params} label="Выберите метод обследования" />}
                                            required
                                        />
                                         <InputError message={errors.method} className="mt-2" />

                                    </div>
                                    <div className="ml-10">
                                        <InputLabel htmlFor='methodology' value='Направление' />
                                        <Autocomplete
                                            disablePortal
                                            id="methodology"
                                            name='methodology'
                                            options={methodologyList}
                                            className="mt-1 block w-full mt-5"
                                            onChange={(e, newValue) => {
                                                setData('methodologyData', newValue ? newValue.id : null)
                                                postDateEnable(e)
                                            }}
                                            isOptionEqualToValue={(option, value) => option.id === value}
                                            sx={{ width: 300 }}
                                            renderInput={(params) => <TextField {...params} label="Выберите направление" />}
                                            required
                                        />
                                         <InputError message={errors.methodology} className="mt-2" />
                                    </div>
                                </div>
                                <div>
                                    <InputLabel htmlFor='employ' value='Врач' />
                                    <Autocomplete
                                        disablePortal
                                        id="employ"
                                        name='employ'
                                        options={EmployerList}
                                        className="mt-1 block w-full mt-5"
                                        onChange={(e, newValue) => {
                                            setData('employeeData', newValue ? newValue.id : null);
                                        }}
                                        isOptionEqualToValue={(option, value) => option.id === value}
                                        sx={{ width: 300 }}
                                        renderInput={(params) => <TextField {...params} label="Выберите врача" />}
                                        required
                                    />
                                    <InputError message={errors.employee} className="mt-2" />
                                </div>
                                <div className="flex ">
                                    <div>
                                        <InputLabel htmlFor='date' value='Дата' />
                                        <ThemeProvider theme={theme}>
                                            <LocalizationProvider dateAdapter={AdapterDayjs} adapterLocale='ru' localeText={ruRU.components.MuiLocalizationProvider.defaultProps.localeText}>
                                                <DateCalendar
                                                    name='date'
                                                    id='date'
                                                    format="MM-DD-YYYY"
                                                    value={data.date}
                                                    onChange={(newValue) => {
                                                        setData('date', newValue);
                                                        getDates();
                                                    }}
                                                    minDate={today}
                                                    shouldDisableDate={isDateDisabled}
                                                    required
                                                />
                                                <InputError message={errors.date} className="mt-2" />
                                            </LocalizationProvider>
                                        </ThemeProvider>

                                    </div>
                                    <div className="ml-10">
                                        <InputLabel htmlFor='time' value='Время' className='mb-3' />
                                        <div className=' container w-auto grid grid-cols-4 gap-4' >
                                            {parseWorkTime().map((elem) =>
                                                <div className="radio ">
                                                    <a className={timeClasses(elem)} onClick={() => { setData('time', elem) }} required>
                                                        {elem}
                                                    </a>
                                                </div>
                                            )}
                                            <InputError message={errors.method} className="mt-2" />


                                        </div>

                                    </div>
                                </div>
                                <PrimaryButton type="submit" disabled={processing}>Записаться</PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
