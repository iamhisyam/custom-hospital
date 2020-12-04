// in src/pages/CategoryList.js
import React from 'react';
import {
    List, 
    Datagrid, 
    TextField,
    DateInput, 
    DateField, 
    NumberField,
    SelectField,
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

export const LabSetupList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="id" />
            <ReferenceField label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <TextField source="name" />
            </ReferenceField>
            <TextField source="name" />
            <TextField source="measure" />
            <TextField source="description" />
            <TextField source="normal_condition" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LabSetupShow = (props) => (
    <Show title="LabSetup" {...props}>
       <SimpleShowLayout>
            <TextField source="id" />
            <ReferenceField label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <TextField optionText="name" optionValue="id" />
            </ReferenceField>
            <TextField source="name" />
            <TextField source="measure" />
            <TextField source="normal_condition" />
            <TextField source="description" />
        </SimpleShowLayout>
    </Show>
);

export const LabSetupCreate = (props) => (
    <Create title="Create a LabSetup" {...props}>
        <SimpleForm>
            <ReferenceInput label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>         
             <TextInput source="name" /> 
            <TextInput source="measure" />
            <TextInput source="normal_condition" />
            <TextInput source="description" />
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>LabSetup {record ? `"${record.name}"` : ''}</span>;
};

const LabSetupEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const LabSetupEdit = (props) => (
    <Edit title={<PostTitle />} actions={<LabSetupEditActions/>} {...props}>
        <SimpleForm>
            <ReferenceInput label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>         
             <TextInput source="name" /> 
            <TextInput source="measure" />
            <TextInput source="normal_condition" />
            <TextInput source="description" />
        </SimpleForm>
    </Edit>
);