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

export const PositionList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="code" />
            <TextField source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const PositionShow = (props) => (
    <Show title="Position" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
        </SimpleShowLayout>
    </Show>
);

export const PositionCreate = (props) => (
    <Create title="Create a Position" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" /> 

        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Position {record ? `"${record.name}"` : ''}</span>;
};

const PositionEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const PositionEdit = (props) => (
    <Edit title={<PostTitle />} actions={<PositionEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="name" />
        </SimpleForm>
    </Edit>
);