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
    TopToolbar,
    ShowButton,
    Show,
    SimpleShowLayout

} from 'react-admin';
import Button from '@material-ui/core/Button';

export const TeamList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="code" />
            <TextField source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const TeamShow = (props) => (
    <Show title="Team" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
        </SimpleShowLayout>
    </Show>
);

export const TeamCreate = (props) => (
    <Create title="Create a Team" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" /> 
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Team {record ? `"${record.name}"` : ''}</span>;
};

const TeamEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const TeamEdit = (props) => (
    <Edit title={<PostTitle />} actions={<TeamEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="code" />
            <TextInput source="name" />
        </SimpleForm>
    </Edit>
);