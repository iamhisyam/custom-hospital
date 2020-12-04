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

export const DepartmentList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <ReferenceField label="Branch" source="branch_id" reference="branches">
                <TextField source="name" />
            </ReferenceField>
            <TextField source="code" />
            <TextField source="name" />
            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const DepartmentShow = (props) => (
    <Show title="Department" {...props}>
       <SimpleShowLayout>

            <ReferenceField label="Branch" source="branch_id" reference="branches">
                <TextField source="name" />
            </ReferenceField>
            <TextField source="code" />
            <TextField source="name" />
        </SimpleShowLayout>
    </Show>
);

export const DepartmentCreate = (props) => (
    <Create title="Create a Department" {...props}>
        <SimpleForm>
        <TextInput source="code" />
            <ReferenceInput label="Branch" source="branch_id" reference="branches"   >
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
           
            <TextInput source="name" /> 
            {/* <TextInput source="teaser" options={{ multiLine: true }} />
            <LongTextInput source="body" />
            <TextInput label="Publication date" source="published_at" />
            <TextInput source="average_note" /> */}
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Department {record ? `"${record.name}"` : ''}</span>;
};

const DepartmentEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const DepartmentEdit = (props) => (
    <Edit title={<PostTitle />} actions={<DepartmentEditActions/>} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <ReferenceInput label="Branch" source="branch_id" reference="branches">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="name" />
        </SimpleForm>
    </Edit>
);