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
    SelectInput  

} from 'react-admin';

export const LeaveList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="id" />
            <DateField source="application_date" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const PostCreate = (props) => (
    <Create title="Create a Leave" {...props}>
        <SimpleForm>
            <DateInput source="application_date" />
            <ReferenceInput label="Employee" source="employee_id" reference="employees">
                <SelectInput optionText="fullname" />
            </ReferenceInput>
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput optionText="name" />
            </ReferenceInput>
            <DateInput source="start_date" />
            <DateInput source="end_date" />
            <TextInput multiline source="reason" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
            {/* <TextInput source="teaser" options={{ multiLine: true }} />
            <LongTextInput source="body" />
            <TextInput label="Publication date" source="published_at" />
            <TextInput source="average_note" /> */}
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Post {record ? `"${record.name}"` : ''}</span>;
};
export const PostEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="id" />
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput  optionText="name" />
            </ReferenceInput>
            <DateField source="application_date" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
        </SimpleForm>
    </Edit>
);