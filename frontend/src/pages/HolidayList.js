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

export const HolidayList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="name" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const HolidayShow = (props) => (
    <Show title="Holiday" {...props}>
       <SimpleShowLayout>
            <TextField source="name" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
        </SimpleShowLayout>
    </Show>
);

export const HolidayCreate = (props) => (
    <Create title="Create a Holiday" {...props}>
        <SimpleForm>
            <TextInput source="name" /> 
            <DateInput source="start_date" /> 
            <DateInput source="end_date" /> 
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Holiday {record ? `"${record.name}"` : ''}</span>;
};

const HolidayEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const HolidayEdit = (props) => (
    <Edit title={<PostTitle />} actions={<HolidayEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="id" />
            <TextInput source="name" /> 
            <DateInput source="start_date" /> 
            <DateInput source="end_date" /> 
        </SimpleForm>
    </Edit>
);