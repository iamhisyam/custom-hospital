// in src/customRoutes.js
import React from 'react';
import { Route } from 'react-router-dom';
import LeaveTrans from '../../pages/LeaveTrans';
import LabTest from '../../pages/LabTest';
import MedicalReport from '../../pages/MedicalReport';

export default [
    <Route exact path="/leavetrans" component={LeaveTrans} />,
    <Route exact path="/labtest" component={LabTest} />,
    <Route exact path="/medicalreport/:id" component={MedicalReport} />,

];