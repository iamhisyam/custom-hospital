import React from 'react';
import {fetchUtils, Admin,Resource,ListGuesser   } from 'react-admin';
//import myDataProvider from './provider/DataProvider';
import myDataProvider from './provider/dataProvider';
import authProvider from './provider/authProvider';
import Dashboard from './pages/Dashboard';
import simpleRestProvider from 'ra-data-simple-rest';

import PostIcon from '@material-ui/icons/Book';
import UserIcon from '@material-ui/icons/People';

import {LeaveList, PostCreate as LpostCreate, PostEdit as LpostEdit} from './pages/LeaveList'
import {CategoryList, PostCreate, PostEdit} from './pages/CategoryList'
import {UserList, UserCreate, UserEdit} from './pages/UserList'
import {UserRoleList, UserRoleCreate, UserRoleEdit, UserRoleShow} from './pages/UserRoleList'
import {LeaveTypeList, LeaveTypeCreate, LeaveTypeEdit, LeaveTypeShow} from './pages/LeaveTypeList'

import {CompanyList,CompanyCreate, CompanyEdit, CompanyShow} from './pages/CompanyList'
import {BranchList,BranchCreate, BranchEdit, BranchShow} from './pages/BranchList'
import {DepartmentList,DepartmentCreate, DepartmentEdit, DepartmentShow} from './pages/DepartmentList'
import {PositionList,PositionCreate, PositionEdit, PositionShow} from './pages/PositionList'
import {TeamList,TeamCreate, TeamEdit, TeamShow} from './pages/TeamList'
import {GradeList,GradeCreate, GradeEdit, GradeShow} from './pages/GradeList'

import {LeaveBalanceList,LeaveBalanceCreate, LeaveBalanceEdit, LeaveBalanceShow} from './pages/LeaveBalanceList'
import {LeaveTransList,LeaveTransCreate, LeaveTransEdit, LeaveTransShow} from './pages/LeaveTransList'
import {HolidayList,HolidayCreate, HolidayEdit, HolidayShow} from './pages/HolidayList'

import {LeaveSetupList,LeaveSetupCreate, LeaveSetupEdit, LeaveSetupShow} from './pages/LeaveSetupList'
import {LeaveTransTypeList,LeaveTransTypeCreate, LeaveTransTypeEdit, LeaveTransTypeShow} from './pages/LeaveTransTypeList'
import {LeaveTransStatusList,LeaveTransStatusCreate, LeaveTransStatusEdit, LeaveTransStatusShow} from './pages/LeaveTransStatusList'

import {PatientList,PatientCreate, PatientEdit, PatientShow} from './pages/PatientList'
import {LabList,LabCreate, LabEdit, LabShow} from './pages/LabList'
import {LabSetupList,LabSetupCreate, LabSetupEdit, LabSetupShow} from './pages/LabSetupList'
import {LabResultList,LabResultCreate, LabResultEdit, LabResultShow} from './pages/LabResultList'
import {MedicalCheckupList,MedicalCheckupCreate, MedicalCheckupEdit, MedicalCheckupShow} from './pages/MedicalCheckupList'


import {EmployeeList,EmployeeCreate, EmployeeEdit} from './pages/EmployeeList'

import {Layout} from './customs/layout/index'

// custom routes
import customRoutes from './customs/routes'



const httpClient = (url, options = {}) => {
 
  if (!options.headers) {
    options.headers = new Headers({ 
     Accept: 'application/json'
   });
  }

 
  const token = localStorage.getItem('token');
  //const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1Njk4NTE5OTcsImV4cCI6MTU2OTg1Mzc5Nywic3ViIjoxfQ._qtrvNygfMQZHbr3UZzYSFSrH7_0OudRvDZ5vBTAZeg'
  options.headers.set('Authorization', `Bearer ${token}`);
 
    return fetchUtils.fetchJson(url, options);
  }

const dataProvider = myDataProvider(process.env.REACT_APP_API_URL,httpClient);
const App = () => (
    <Admin 
      dataProvider={dataProvider} 
      authProvider={authProvider}
      dashboard={Dashboard}
      customRoutes={customRoutes}
      layout={Layout}
    >
      <Resource name="patients" list={PatientList} create={PatientCreate} edit={PatientEdit}  show={PatientShow} /> 
      <Resource name="labs" list={LabList} create={LabCreate} edit={LabEdit}  show={LabShow} /> 
      <Resource name="labs_setup" list={LabSetupList} create={LabSetupCreate} edit={LabSetupEdit}  show={LabSetupShow} /> 
      <Resource name="labs_result" list={LabResultList} create={LabResultCreate} edit={LabResultEdit}  show={LabResultShow} /> 
      
      <Resource name="medical_checkups" list={MedicalCheckupList} create={MedicalCheckupCreate} edit={MedicalCheckupEdit}  show={MedicalCheckupShow} /> 
      
      <Resource name="leaves_balance" list={LeaveBalanceList} create={LeaveBalanceCreate} edit={LeaveBalanceEdit}  show={LeaveBalanceShow} /> 

      <Resource name="leaves_trans" list={LeaveTransList} create={LeaveTransCreate} edit={LeaveTransEdit}  show={LeaveTransShow} /> 
      
      <Resource name="companies" list={CompanyList} create={CompanyCreate} edit={CompanyEdit} show={CompanyShow}  /> 
      <Resource name="branches" list={BranchList} create={BranchCreate} edit={BranchEdit}  show={BranchShow} /> 
      <Resource name="departments" list={DepartmentList} create={DepartmentCreate} edit={DepartmentEdit}  show={DepartmentShow} /> 
      <Resource name="positions" list={PositionList} create={PositionCreate} edit={PositionEdit}  show={PositionShow} /> 
      <Resource name="teams" list={TeamList} create={TeamCreate} edit={TeamEdit}  show={TeamShow} /> 
      <Resource name="grades" list={GradeList} create={GradeCreate} edit={GradeEdit}  show={GradeShow} /> 
      <Resource name="holidays" list={HolidayList} create={HolidayCreate} edit={HolidayEdit}  show={HolidayShow} /> 
      <Resource name="leave_setup" list={LeaveSetupList} create={LeaveSetupCreate} edit={LeaveSetupEdit}  show={LeaveSetupShow} /> 
      <Resource name="leave_type" list={LeaveTypeList} create={LeaveTypeCreate} edit={LeaveTypeEdit}  show={LeaveTypeShow} /> 
      <Resource name="leave_trans_type" list={LeaveTransTypeList} create={LeaveTransTypeCreate} edit={LeaveTransTypeEdit}  show={LeaveTransTypeShow} /> 
      <Resource name="leave_trans_status" list={LeaveTransStatusList} create={LeaveTransStatusCreate} edit={LeaveTransStatusEdit}  show={LeaveTransStatusShow} /> 
      <Resource name="employees" list={EmployeeList} create={EmployeeCreate} edit={EmployeeEdit} icon={UserIcon} /> 
      {/* <Resource name="leaves" list={LeaveList}  create={LpostCreate} edit={LpostEdit} icon={PostIcon} />  */}
      {/* <Resource name="categories" list={CategoryList}  create={PostCreate} edit={PostEdit} /> */}
      <Resource name="users" list={UserList}  create={UserCreate} edit={UserEdit} />
      <Resource name="user_roles" list={UserRoleList}  create={UserRoleCreate} edit={UserRoleEdit} show={UserRoleShow}/>
    </Admin>
);

export default App;