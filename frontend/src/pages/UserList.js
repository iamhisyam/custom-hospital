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
    SelectInput ,
    ReferenceInput
} from 'react-admin';

export const UserList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="id" />
            <TextField source="username" />
            <TextField source="email" />
            <ReferenceField label="Role" source="user_role_id" reference="user_roles" >
                <TextField source="name" />
            </ReferenceField>
            
            <TextField source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const UserCreate = (props) => (
    <Create title="Create a User" {...props}>
        <SimpleForm>
            <TextInput source="name"/> 
            <TextInput source="email"/>
            <ReferenceInput label="Role" source="user_role_id" reference="user_roles"  allowNull={true} >
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>  
            <TextInput source="username" />
            <TextInput source="password" type="password"/>            
            <DateField source="created_at" />
            <DateField source="updated_at" />
            {/* <TextInput source="teaser" options={{ multiLine: true }} />
            <LongTextInput source="body" />
            <TextInput label="Publication date" source="published_at" />
            <TextInput source="average_note" /> */}
        </SimpleForm>
    </Create>
);

const UserTitle = ({ record }) => {
    return <span>User {record ? `"${record.name}"` : ''}</span>;
};

export const UserEdit = (props) => (
    <Edit title={<UserTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="id" />
            <TextInput source="name"/>  
            <TextInput source="email"/>  
            <ReferenceInput label="Role" source="user_role_id" reference="user_roles"  allowNull={true} >
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>  
            <TextInput source="username" />

            <TextInput source="password" type="password"/>  
        </SimpleForm>
    </Edit>
);