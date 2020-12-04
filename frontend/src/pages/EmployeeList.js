// in src/pages/EmployeeList.js
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
    NumberInput,
    ReferenceInput,
    SelectInput  

} from 'react-admin';

export const EmployeeList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="code" />
            <TextField source="fullname" />
            <ReferenceField label="Grade" source="grade_id" reference="grades" link="show">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Company" source="company_id" reference="companies" link="show">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Branch" source="branch_id" reference="branches" link="show">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Department" source="department_id" reference="departments" link="show">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Team" source="team_id" reference="teams" link="show">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Position" source="position_id" reference="positions" link="show">
                <TextField source="name" />
            </ReferenceField>
           
            <TextField source="npwp" />
            <TextField source="join_at" />
       
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const EmployeeCreate = (props) => (
    <Create title="Add a Employee" {...props}>
        <SimpleForm >
            <TextInput source="code" />
            <TextInput source="fullname" />   
            <ReferenceInput label="Company" source="company_id" reference="companies">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Branch" source="branch_id" reference="branches">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Department" source="department_id" reference="departments">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Position" source="position_id" reference="positions">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Team" source="team_id" reference="teams">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Grade" source="grade_id" reference="grades">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="employment" /> 
            <TextInput source="religion" /> 
            
            <NumberInput source="employment_type" /> 
            <NumberInput source="salary" /> 
            <DateInput source="join_at" />
            <DateInput source="resign_at" />
            <TextInput source="status" /> 
            <TextInput source="sex" /> 
            <TextInput source="email" /> 
            <TextInput source="password" /> 
            <TextInput source="point" /> 

        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span> {record ? `"${record.fullname}"` : ''}</span>;
};
export const EmployeeEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <TextInput source="fullname" />   
            <ReferenceInput label="Company" source="company_id" reference="companies">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Branch" source="branch_id" reference="branches">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Department" source="department_id" reference="departments">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Position" source="position_id" reference="positions">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Team" source="team_id" reference="teams">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Grade" source="grade_id" reference="grades">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="employment" /> 
            <TextInput source="religion" /> 
            
            <NumberInput source="employment_type" /> 
            <NumberInput source="salary" /> 
            <DateInput source="join_at" />
            <DateInput source="resign_at" />
            <TextInput source="status" /> 
            <TextInput source="sex" /> 
            <TextInput source="email" /> 
            <TextInput source="password" /> 
            <TextInput source="point" /> 
        </SimpleForm>
    </Edit>
);