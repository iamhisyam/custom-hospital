// in src/pages/CategoryList.js
import React from 'react';
import {
    List, 
    Datagrid, 
    TextField,
    NumberInput,
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

export const GradeList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="code" />
            <TextField source="name" />
            <TextField source="level" />
            <NumberField source="salary_min" />
            <NumberField source="salary_mid" />
            <NumberField source="salary_max" />

            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const GradeShow = (props) => (
    <Show title="Grade" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
            <TextField source="level" />
            <NumberField source="salary_min" />
            <NumberField source="salary_mid" />
            <NumberField source="salary_max" />

        </SimpleShowLayout>
    </Show>
);

export const GradeCreate = (props) => (
    <Create title="Create a Grade" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" /> 
            <TextInput source="level" /> 
            <NumberInput source="salary_min" /> 
            <NumberInput source="salary_mid" /> 
            <NumberInput source="salary_max" /> 


        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Grade {record ? `"${record.name}"` : ''}</span>;
};

const GradeEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const GradeEdit = (props) => (
    <Edit title={<PostTitle />} actions={<GradeEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="code" />
            <TextInput source="name" />
            <TextInput source="level" /> 
            <NumberInput source="salary_min" /> 
            <NumberInput source="salary_mid" /> 
            <NumberInput source="salary_max" /> 

        </SimpleForm>
    </Edit>
);