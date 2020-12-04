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

export const LabList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="id" />
            <TextField source="name" />
            <TextField source="description" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LabShow = (props) => (
    <Show title="Lab" {...props}>
       <SimpleShowLayout>
            <TextField source="id" />
            <TextField source="name" />
            <TextField source="description" />
        </SimpleShowLayout>
    </Show>
);

export const LabCreate = (props) => (
    <Create title="Create a Lab" {...props}>
        <SimpleForm>         
             <TextInput source="name" /> 
            <TextInput source="description" />
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Lab {record ? `"${record.name}"` : ''}</span>;
};

const LabEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const LabEdit = (props) => (
    <Edit title={<PostTitle />} actions={<LabEditActions/>} {...props}>
        <SimpleForm>
            <TextInput source="name" />
            <TextInput source="description" />
        </SimpleForm>
    </Edit>
);