// in src/pages/CategoryList.js
import React from 'react';
import { List, Datagrid, TextField,NumberInput, DateField, NumberField,ReferenceField, SimpleForm, Create, Edit, TextInput, Show, SimpleShowLayout } from 'react-admin';

export const LeaveTransTypeList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="code" />
            <TextField source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LeaveTransTypeCreate = (props) => (
    <Create title="Create a Leave Trans Type" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" />
        </SimpleForm>
    </Create>
);

const LeaveTransTypeTitle = ({ record }) => {
    return <span>Leave Type {record ? `"${record.name}"` : ''}</span>;
};
export const LeaveTransTypeEdit = (props) => (
    <Edit title={<LeaveTransTypeTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="name" />     
        </SimpleForm>
    </Edit>
);


export const LeaveTransTypeShow = (props) => (
    <Show title="Leave Type" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
        </SimpleShowLayout>
    </Show>
);
