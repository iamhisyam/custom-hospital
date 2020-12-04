// in src/pages/CategoryList.js
import React from 'react';
import {
    List, 
    Datagrid, 
    TextField,
    DateInput, 
    DateField, 
    NumberField,
    ReferenceField, 
    SimpleForm, 
    Create, 
    Edit, 
    TextInput, 
    ReferenceInput,
    SelectInput ,
    TabbedForm, 
    FormTab,
    Show,
    SimpleShowLayout,
    TabbedShowLayout, 
    Tab

} from 'react-admin';


import {validateCompanyCreation} from '../validations/CompanyValidation'

export const CompanyList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="npwp" />
            <TextField source="name" />
            <TextField source="address" />
            <TextField source="phone" />
          
        </Datagrid>
    </List>
);


export const CompanyCreate = (props) => (
    <Create title="Create a Company" {...props}>
       <TabbedForm validate={validateCompanyCreation}>
            <FormTab label="summary">
                <TextInput source="name" />
                <TextInput source="npwp" />
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
            <FormTab label="others">
                <TextInput source="level" />
                <TextInput source="npp" />
                <TextInput source="kpa" />
                <TextInput source="max_npwp" />
                <TextInput source="klu" />
            </FormTab>
        </TabbedForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Post {record ? `"${record.name}"` : ''}</span>;
};
export const CompanyEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
       <TabbedForm validate={validateCompanyCreation}>
            <FormTab label="summary">
                <TextInput source="name" />
                <TextInput source="npwp" />
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
            <FormTab label="others">

                <TextInput source="level" />
                <TextInput source="npp" />
                <TextInput source="kpa" />
                <TextInput source="max_npwp" />
                <TextInput source="klu" />
            </FormTab>
        </TabbedForm>
    </Edit>
);

export const CompanyShow = (props) => (
    <Show title="Company" {...props}>
       <TabbedShowLayout>
            {/* <ReferenceField label="Company" source="company_code" reference="companies">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Branch" source="branch_code" reference="branches">
                <TextField source="name" />
            </ReferenceField> */}
            <Tab label="summary">
                <TextField label="Id" source="id" />
                <TextField source="name" />
                <TextField source="npwp" />
            </Tab>
            <Tab label="contact">
                <TextField label="Address" source="address" />
                <TextField label="Phone" source="phone" />
                <TextField source="city" />
                <TextField source="zip" />
                <TextField source="fax" />
                <TextField source="kelurahan" />
                <TextField source="kecamatan" />
            </Tab>
            <Tab label="others">
                <TextField label="level" source="level" />
                <TextField source="npp" />
                <TextField source="kpa" />
                <TextField source="max_npwp" />
                <TextField source="klu" />
            </Tab>
            
        </TabbedShowLayout>
    </Show>
);