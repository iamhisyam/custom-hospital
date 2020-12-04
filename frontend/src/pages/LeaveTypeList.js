// in src/pages/CategoryList.js
import React from 'react';
import { List, Datagrid, TextField,NumberInput, DateField, NumberField,ReferenceField, SimpleForm, Create, Edit, TextInput, Show, SimpleShowLayout } from 'react-admin';

export const LeaveTypeList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="code" />
            <TextField source="name" />
            
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LeaveTypeCreate = (props) => (
    <Create title="Create a Leave Type" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" />
        </SimpleForm>
    </Create>
);

const LeaveTypeTitle = ({ record }) => {
    return <span>Leave Type {record ? `"${record.name}"` : ''}</span>;
};
export const LeaveTypeEdit = (props) => (
    <Edit title={<LeaveTypeTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="name" />

        </SimpleForm>
    </Edit>
);


export const LeaveTypeShow = (props) => (
    <Show title="Leave Type" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
        </SimpleShowLayout>
    </Show>
);
