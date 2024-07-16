import PrimaryButton from "@/Components/PrimaryButton";
import * as React from 'react';

import { useForm, usePage } from "@inertiajs/react";
import DangerButton from "@/Components/DangerButton";
import { useState } from "react";
import Modal from "@/Components/Modal";
import { FocusTrap } from "@headlessui/react";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import SecondaryButton from "@/Components/SecondaryButton";




export default function MyExam({ workTime, guzle }) {
    const user = usePage().props.auth.user;

    const { data, setData, processing, put, get } = useForm({
        descript: null,
        id: null,
    });
    const [isModalOpen, setIsModalOpen] = useState(false);


    const openModal = (id) => {
        setData({ ...data, id: id })
        setIsModalOpen(true);
    };
    const closeModal = () => {
        setIsModalOpen(false);
    };
    const updateStatus = (e) => {
        e.preventDefault();
        put(route('status.update', data.id), {
            body: {
                id: data.id,
                descript: data.descript
            },
            onSuccess: () => {
                closeModal();
            },
            onError: (e) => { console.log(e) }
        });
    }

    const editEx = (e, id) => {
        e.preventDefault();
        window.open(route('Edit.exam', [id]))
    }

    const downloadPdf = (e) => {
        e.preventDefault();
        window.open(route('exLoad', data.id))
        // setData({ ...data, id: id })
        // get(route('exLoad', data.id), {
        //     body: {
        //         id: data.id,

        //     },
        //     onSuccess: () => {
        //         console, log('Скачивание', data.id)
        //     },
        //     onError: (e) => { console.log(e) }
        // });
    }


    const status = {
        "-1": 'Отменено',
        5: 'Описание выдано',
        10: 'Описание готово',
        11: 'Описание готово - ожидание распечатки',
        12: 'Проверено',
        14: 'Требуется доработка',
        15: 'Описание на проверке',
        20: 'Описание отложено',
        24: 'Удаленная проверк',
        25: 'Исследование завершено',
        30: 'Исследование начато',
        35: 'Приход',
        40: 'Дозвонились',
        45: 'Не дозвонились',
        50: 'Записан на исследование',
        55: 'Предварительно записан',
    };

    const cancelList = {
        1: 'Отказ',
        2: 'Длительное опоздание',
        5: 'Не пришел',
        3: 'Технические условия',
        4: 'Другое',
        6: 'Отменена пациентом'
    }


    const ExTime = workTime.filter((elem) => elem.pacient_id == user.pacient_id)
        .map((elem) => [
          
                <tr className={elem.status != -1 ? "grid grid-cols-8 gap-6 bg-white rounded-full mt-5 p-1 border-2 border-emerald-400" : "grid grid-cols-8 gap-6 bg-white rounded-full mt-5 p-1 border-2 border-rose-400"}>

                    <td >{elem.date}</td>
                    <td>{'c ' + elem.time_start}</td>
                    <td>{elem.methods.short_name}</td>
                    <td>{elem.methodologys.name}</td>
                    <td>{elem.employees.last_name + ' ' + elem.employees.first_name + ' ' + elem.employees.fathers_name}</td>
                    <td>{elem.contrast ? elem.contrast.name : '-'}</td>
                    <td>{elem.status === -1 ? cancelList[6] : status[elem.status]}</td>
                    {elem.status == 55 || elem.status == 50 ? (
                        <td>
                            <DangerButton onClick={() => openModal(elem.research_id)}>Отменить</DangerButton>
                            <PrimaryButton className="mt-2" onClick={(e) => editEx(e, elem.research_id)}>Изменить</PrimaryButton>
                        </td>
                    ) : elem.status === 10 ? (<td><button onClick={(e) => downloadPdf(e, elem.research_id)}><svg width="40px" height="40px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>pdf-document</title>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)">
                                <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf">

                                </path>
                            </g>
                        </g>
                    </svg></button></td>)
                        : elem.status == -1 ? (<></>)
                            : (<td>Ожидайте</td>)}
                 </tr>
        ]);





    return (
        <section>
            <header className="flex w-auto text-clip">
                <h2 className="text-lg font-medium text-gray-900 w-1/2">Информация о ваших обследованях</h2>

            </header>


            <a href="/createExam" className="btn btn-primary">
                <PrimaryButton disabled={processing}>
                    Записаться на прием
                </PrimaryButton>
            </a>

            <div className="space-x-10 mt-10 bg-gray-200 rounded-lg p-8 grid text-center">

                <table className="table-auto justify-center ">
                    <thead>
                        <tr className="flex grid grid-cols-8 gap-6">
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Метод</th>
                            <th>Зона</th>
                            <th>Врач</th>
                            <th>Контраст</th>
                            <th>Статус</th>
                            <th>Скачать</th>
                        </tr>
                    </thead>
                    <tbody>

                        {ExTime}

                    </tbody>
                </table>
                <Modal
                    show={isModalOpen}
                    onClose={closeModal}
                    maxWidth="md"
                    closeable={true}
                >
                    <div className="p-10 flex flex-col items-center justify-center space-y-4">
                        <InputLabel>Пожалуйста,укажите причину отмены заявки</InputLabel>
                        <TextInput id='descript' name='descript' value={data.descript} onChange={(e) => setData('descript', e.target.value)} />

                        <DangerButton type="submit" onClick={(e) => updateStatus(e)}>Отменить запись</DangerButton>
                        <SecondaryButton onClick={closeModal}>Оставить</SecondaryButton>
                    </div>
                </Modal>
            </div>
        </section>

    )
}
