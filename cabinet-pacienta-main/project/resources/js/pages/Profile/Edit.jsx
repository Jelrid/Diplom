import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import MyExam from './Partials/MyExam';
import UpdateProfileName from './Partials/UpdateProfile';
import { Head } from '@inertiajs/react';

import * as React from 'react';
import PropTypes from 'prop-types';
import Tabs from '@mui/material/Tabs';
import Tab from '@mui/material/Tab';
import Typography from '@mui/material/Typography';
import Box from '@mui/material/Box';
import ScheduleEmployee from './Partials/ScheduleEmployee';

function CustomTabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box sx={{ p: 3 }}>
                    <Typography component={'span'} variant={'body2'}>{children}</Typography>
                </Box>
            )}
        </div>
    );
}

CustomTabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.number.isRequired,
    value: PropTypes.number.isRequired,

};

function a11yProps(index) {
    return {
        id: `simple-tab-${index}`,
        'aria-controls': `simple-tabpanel-${index}`,
    };
}

export default function Edit({ auth, workTime, guzle, methods, methodology, sheduleOkTime }) {

    const [value, setValue] = React.useState(0);
    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
        >
            <Head title="Профиль" />

            <div className="py-12">
                <div className="max-w-9xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <Tabs value={value} onChange={handleChange}>
                        <Tab label="Ваши обследования" {...a11yProps(1)} />
                        <Tab label="Личные данные" {...a11yProps(0)} />
                        <Tab label="Расписание врачей" {...a11yProps(2)} />
                    </Tabs>
                    <CustomTabPanel value={value} index={0}>

                        <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <MyExam className="max-w-xl"
                                guzle={guzle}
                                workTime={workTime} />
                        </div>
                    </CustomTabPanel>
                    <CustomTabPanel value={value} index={1}>
                        <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <UpdateProfileName
                                className="max-w-xl"
                            />
                        </div>
                    </CustomTabPanel>
                    <CustomTabPanel value={value} index={2}>
                        <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <ScheduleEmployee
                                className="max-w-xl"
                                workTime={workTime}
                                methods={methods}
                                methodology={methodology}
                                sheduleOkTime={sheduleOkTime}

                            />
                        </div>
                    </CustomTabPanel>




                </div>
            </div>
        </AuthenticatedLayout>
    );
}
