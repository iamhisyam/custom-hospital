// in src/pages/CategoryList.js
import React from 'react';
import { List, Datagrid, TextField, DateField, NumberField,ReferenceField, SimpleForm, Create, Edit, TextInput } from 'react-admin';

export const CategoryList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="id" />
            <TextField source="name" />
            {/* <ReferenceField source="user_id" reference="users"><TextField source="id" /></ReferenceField> */}
            <DateField source="created_at" />
            <DateField source="updated_at" />
            <NumberField source="todos_count" />
        </Datagrid>
    </List>
);


export const PostCreate = (props) => (
    <Create title="Create a Category" {...props}>
        <SimpleForm>
            <TextInput source="name" />
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
            <TextInput source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
        </SimpleForm>
    </Edit>
);