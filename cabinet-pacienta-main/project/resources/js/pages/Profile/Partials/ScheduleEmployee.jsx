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
// import { AdapterLuxon } from '@mui/x-date-pickers/AdapterLuxon';
import { DateCalendar } from '@mui/x-date-pickers/DateCalendar';
import { createTheme, ThemeProvider } from '@mui/material/styles';

// import { ruRU as dataGridruRU } from '@mui/x-data-grid';
import { ruRU as coreruRU } from '@mui/material/locale';
import { ruRU } from '@mui/x-date-pickers/locales';
import * as dayjs from 'dayjs'

import updateLocale from 'dayjs/plugin/updateLocale';
import { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import Button from '@mui/material/Button';



export default function ScheduleEmployee({ workTime, methods, methodology, sheduleOkTime }) {

    dayjs.extend(updateLocale);
    dayjs.updateLocale('en', {
        // Sunday = 0, Monday = 1.
        weekStart: 1,
    });


    
    
    const { data, setData } = useForm({
        methoData: null,
        methodologyData: null,
        employeeData: null,
        dayData: null,
        date: dayjs(),
    });

    const today = dayjs();

    const isDateDisabled = (date) => {
        const dayjsDate = dayjs(date);
        // Проверяем, присутствует ли дата в списке доступных дат
        return dayjsDate.day() === 0;
      };
    
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
    
    
    const [WorkTimes, setWorkTimes] = useState([])
    
    
    const parseWorkTime = () => {
        const elem = WorkTimes.find((elem) => elem.employee_id === data.employeeData);
        const timeSeans = methodology.find((elem) => elem.methodology_id === data.methodologyData)
        let rows = [];
        if (elem) {
            const timeStart = dayjs(formatingData + elem.time_start)
            const timeEnd = dayjs(formatingData + elem.time_end)
            
            
            rows.push(timeStart.format('HH:mm') + ' до ' + timeEnd.format('HH:mm'));
        }
        return rows;
    }
    
    const dateClasses = () => {
        if (workTime.time_start && data.employeeData === sheduleOkTime.employee_id) {
            return 'lightgreen';
        } else {
            return 'red'
        }
    }
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
                            backgroundColor: {dateClasses},
                            localization: 'ru'
                        }
                    }
                }
            },
        },
        ruRU,
        coreruRU
    );



    return (
        <section>


            <div className="py-12">
                <div className="max-w-9xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <header className="flex w-auto text-clip">
                        <h2 className="text-lg font-medium text-gray-900 w-1/2">Расписание врачей</h2>

                    </header>

                    <Head title="CreateExam" />
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
                                    setData('methodologyData', newValue ? newValue.id : null);
                                }}
                                isOptionEqualToValue={(option, value) => option.id === value}
                                sx={{ width: 300 }}
                                renderInput={(params) => <TextField {...params} label="Выберите направление" />}
                                required
                            />
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
                    </div>
                    <div className="flex ">
                        <div>
                            <InputLabel htmlFor='date' value='Дата' />
                            <ThemeProvider theme={theme}>
                                <LocalizationProvider dateAdapter={AdapterDayjs} adapterLocale='ru' localeText={ruRU.components.MuiLocalizationProvider.defaultProps.localeText}>
                                    <DateCalendar
                                        name='date'
                                        format="MM-DD-YYYY"
                                        value={data.date}
                                        onChange={(newValue) => {
                                            setData('date', newValue);
                                            getDates();
                                        }}
                                        shouldDisableDate={isDateDisabled}
                                        minDate={today}
                                        required
                                    />
                                </LocalizationProvider>
                            </ThemeProvider>

                        </div>
                        <div className="ml-10">
                            <InputLabel htmlFor='time' value='Время' className='mb-3' />
                            <div className=' container w-auto grid grid-cols-4 gap-4' >
                                Время работы:  
                                {parseWorkTime().filter((elem) =>
                                    <div>
                                        {elem}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}
