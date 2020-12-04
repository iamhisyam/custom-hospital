// in src/pages/CategoryList.js
import React from 'react';
import {
    List, 
    Datagrid, 
    TextField,
    BooleanField,
    DateInput, 
    DateField, 
    NumberField,
    ReferenceField, 
    SimpleForm, 
    Create, 
    Edit, 
    TextInput, 
    NumberInput,
    ReferenceInput,
    BooleanInput,
    SelectInput ,
    TabbedForm, 
    FormTab,
    Show,
    SimpleShowLayout,
    TabbedShowLayout, 
    Tab

} from 'react-admin';


//import {validatePatientCreation} from '../validations/PatientValidation'

export const PatientList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="code" />
            <TextField source="name" />
            <TextField source="address" />
            <TextField source="phone" />
          
        </Datagrid>
    </List>
);


export const PatientCreate = (props) => (
    <Create title="Create a Patient" {...props}>
       <TabbedForm >
       <FormTab label="summary">
                <TextInput source="name" />
                <TextInput source="code" />
            </FormTab>
            <FormTab label="contact">
                <TextInput source="address" />
                <TextInput source="phone" />
                <TextInput source="city" />
                <TextInput source="kelurahan" />
                <TextInput source="kecamatan" />
                <TextInput source="zip" />
                <TextInput source="fax" />
            </FormTab>
            <FormTab label="record">

                <BooleanInput source="ever_had_disease" />
                <BooleanInput source="ever_had_treated" />
                <BooleanInput source="ever_had_surgery" />
                <BooleanInput source="ever_had_accident" />
                
            </FormTab>
            <FormTab label="habit">

                <BooleanInput source="smoking_habit" />
                <BooleanInput source="alcohol_habit" />
                <BooleanInput source="coffe_habit" />
                <BooleanInput source="exercise_habit" />
                
            </FormTab>
            <FormTab label="condition">

                <BooleanInput source="had_hypertension" />
                <BooleanInput source="had_diabetes" />
                <BooleanInput source="had_heart_disease" />
                <BooleanInput source="had_kidney_disease" />
                <BooleanInput source="had_mentally_ill" />

                <BooleanInput source="is_being_treated" />
                <NumberInput source="long_being_sick" />
                <BooleanInput source="being_sick" />
                <TextInput source="sickness" />
     
            </FormTab>
        </TabbedForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Post {record ? `"${record.name}"` : ''}</span>;
};
export const PatientEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
       <TabbedForm >
            <FormTab label="summary">
                <TextInput source="name" />
                <TextInput source="code" />
            </FormTab>
            <FormTab label="contact">
                <TextInput source="address" />
                <TextInput source="phone" />
                <TextInput source="city" />
                <TextInput source="kelurahan" />
                <TextInput source="kecamatan" />
                <TextInput source="zip" />
                <TextInput source="fax" />
            </FormTab>
            <FormTab label="record">

                <BooleanInput source="ever_had_disease" />
                <BooleanInput source="ever_had_treated" />
                <BooleanInput source="ever_had_surgery" />
                <BooleanInput source="ever_had_accident" />
                
            </FormTab>
            <FormTab label="habit">

                <BooleanInput source="smoking_habit" />
                <BooleanInput source="alcohol_habit" />
                <BooleanInput source="coffe_habit" />
                <BooleanInput source="exercise_habit" />
                
            </FormTab>
            <FormTab label="condition">

                <BooleanInput source="had_hypertension" />
                <BooleanInput source="had_diabetes" />
                <BooleanInput source="had_heart_disease" />
                <BooleanInput source="had_kidney_disease" />
                <BooleanInput source="had_mentally_ill" />

                <BooleanInput source="is_being_treated" />
                <NumberInput source="long_being_sick" />
                <BooleanInput source="being_sick" />
                <TextInput source="sickness" />
     
            </FormTab>
        </TabbedForm>
    </Edit>
);

export const PatientShow = (props) => (
    <Show title="Patient" {...props}>
       <TabbedShowLayout>
            <Tab label="summary">
                <TextField source="name" />
                <TextField source="code" />
            </Tab>
            <Tab label="contact">
                <TextField source="address" />
                <TextField source="phone" />
                <TextField source="city" />
                <TextField source="kelurahan" />
                <TextField source="kecamatan" />
                <TextField source="zip" />
                <TextField source="fax" />
            </Tab>
            <Tab label="record">

                <BooleanField source="ever_had_disease" />
                <BooleanField source="ever_had_treated" />
                <BooleanField source="ever_had_surgery" />
                <BooleanField source="ever_had_accident" />
                
            </Tab>
            <Tab label="habit">

                <BooleanField source="smoking_habit" />
                <BooleanField source="alcohol_habit" />
                <BooleanField source="coffe_habit" />
                <BooleanField source="exercise_habit" />
                
            </Tab>
            <Tab label="condition">

                <BooleanField source="had_hypertension" />
                <BooleanField source="had_diabetes" />
                <BooleanField source="had_heart_disease" />
                <BooleanField source="had_kidney_disease" />
                <BooleanField source="had_mentally_ill" />

                <BooleanField source="is_being_treated" />
                <NumberField source="long_being_sick" />
                <BooleanField source="being_sick" />
                <TextField source="sickness" />
     
            </Tab>
            
        </TabbedShowLayout>
    </Show>
);