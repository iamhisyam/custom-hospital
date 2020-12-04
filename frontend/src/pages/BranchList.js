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
    SelectInput,
    SimpleShowLayout,
    Show,
    ReferenceManyField,
    SingleFieldList  

} from 'react-admin';

export const BranchList = props => (
    <List {...props}>
        <Datagrid rowClick="edit">
            <TextField source="code" />
            <ReferenceField label="Company" source="company_id" reference="companies" link="show" allowEmpty={true}>
                <TextField source="name" />
            </ReferenceField>
            {/* <ReferenceManyField
                reference="companies"
                target="npwp_company"
            >
                <SingleFieldList>
                    <TextField source="name" />
                </SingleFieldList>
            </ReferenceManyField> */}
            <TextField source="name" />
            <TextField source="address" />
            <TextField source="phone" />
            <TextField source="level" />
            {/* <DateField source="created_at" /> */}
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const BranchCreate = (props) => (
    <Create title="Create a Branch" {...props}>
        <SimpleForm >
            {/* initialValues={{branch_code:0,level:0}} */}
            <TextInput source="code" />
            <ReferenceInput label="Company" source="company_id" reference="companies">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            {/* <ReferenceInput label="Branch" source="branch_code" reference="branches">
                <SelectInput optionText="name" optionValue="code" />
            </ReferenceInput> */}
            <TextInput source="name" />
            <TextInput source="address" />
            <TextInput source="phone" />
            <TextInput source="level" />
            {/* <DateField source="created_at" />
            <DateField source="updated_at" /> */}
            {/* <TextInput source="teaser" options={{ multiLine: true }} />
            <LongTextInput source="body" />
            <TextInput label="Publication date" source="published_at" />
            <TextInput source="average_note" /> */}
        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Post {record ? `"${record.name}"` : ''}</span>;
};
export const BranchEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
        <SimpleForm>
            <TextInput disabled source="code" />
            <ReferenceInput label="Company" source="company_id" reference="companies">
                <SelectInput optionText="name" optionValue="id"/>
            </ReferenceInput>
            <ReferenceInput label="Branch" source="branch_id" reference="branches">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="name" />
            <TextInput source="address" />
            <TextInput source="phone" />
            <TextInput source="level" />
            {/* <DateField source="created_at" />
            <DateField source="updated_at" /> */}
        </SimpleForm>
    </Edit>
);


export const BranchShow = (props) => (
    <Show title="Branch" {...props}>
       <SimpleShowLayout>
            <ReferenceField label="Company" source="npwp_company" reference="companies">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Branch" source="branch_code" reference="branches">
                <TextField source="name" />
            </ReferenceField>
            <TextField source="name" />
            <TextField source="address" />
            <TextField source="phone" />
            <TextField source="level" />
        </SimpleShowLayout>
    </Show>
);