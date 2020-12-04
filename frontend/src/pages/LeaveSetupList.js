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
    NumberInput,
    TextInput, 
    ReferenceInput,
    SelectInput ,
    TopToolbar,
    ShowButton,
    Show,
    SimpleShowLayout

} from 'react-admin';
import Button from '@material-ui/core/Button';

export const LeaveSetupList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="code" />
            <TextField source="name" />
            <TextField source="year" />
            <TextField source="days_per_year" />
            <TextField source="days_per_month" />
            <TextField source="days" />
            <ReferenceField source="grade_id" reference="grades">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_type_id" reference="leave_type">
                <TextField source="name" />
            </ReferenceField>
            <NumberField source="expire_count" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LeaveSetupShow = (props) => (
    <Show title="LeaveSetup" {...props}>
       <SimpleShowLayout>
            <TextField source="code" />
            <TextField source="name" />
            <TextField source="year" />
            <TextField source="days_per_year" />
            <TextField source="days_per_month" />
            <TextField source="days" />
            
            <ReferenceField source="grade_id" reference="grades">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_type_id" reference="leave_type">
                <TextField source="name" />
            </ReferenceField>
            <NumberField source="expire_count" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
        </SimpleShowLayout>
    </Show>
);

export const LeaveSetupCreate = (props) => (
    <Create title="Create a LeaveSetup" {...props}>
        <SimpleForm>
            <TextInput source="code" />
            <TextInput source="name" /> 
            <ReferenceInput label="Grade" source="grade_id" reference="grades">
                <SelectInput source="name" />
            </ReferenceInput>
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput source="name" />
            </ReferenceInput>
            <NumberInput source="year" /> 
            <NumberInput source="days_per_year" /> 
            <NumberInput source="days_per_month" /> 
            <NumberInput source="days" /> 
            <NumberInput source="expire_count" /> 

           

        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>LeaveSetup {record ? `"${record.name}"` : ''}</span>;
};

const LeaveSetupEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const LeaveSetupEdit = (props) => (
    <Edit title={<PostTitle />} actions={<LeaveSetupEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="code" />
            <TextInput source="name" />
            <ReferenceInput label="Grade" source="grade_id" reference="grades">
                <SelectInput source="name" />
            </ReferenceInput>
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput source="name" />
            </ReferenceInput>
            <NumberInput source="year" /> 
            <NumberInput source="days_per_year" /> 
            <NumberInput source="days_per_month" /> 
            <NumberInput source="days" /> 
            <NumberInput source="expire_count" /> 

        </SimpleForm>
    </Edit>
);