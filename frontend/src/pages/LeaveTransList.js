
import React, { cloneElement, Fragment } from 'react';
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
    Button,
    Show,
    SimpleShowLayout,
    CreateButton, 
    ExportButton,  
    sanitizeListRestProps,
    BulkDeleteButton, 
    BulkExportButton

} from 'react-admin';
//import Button from '@material-ui/core/Button';

import ApproveBulkButton from "./LeaveTrans/ApproveBulkButton"
import RejectBulkButton from "./LeaveTrans/RejectBulkButton"


import IconEvent from '@material-ui/icons/Event';

const ListActions = ({
    currentSort,
    className,
    resource,
    filters,
    displayedFilters,
    exporter, // you can hide ExportButton if exporter = (null || false)
    filterValues,
    permanentFilter,
    hasCreate, // you can hide CreateButton if hasCreate = false
    basePath,
    selectedIds,
    onUnselectItems,
    showFilter,
    maxResults,
    total,
    ...rest
}) => (
    <TopToolbar className={className} {...sanitizeListRestProps(rest)}>
        {filters && cloneElement(filters, {
            resource,
            showFilter,
            displayedFilters,
            filterValues,
            context: 'button',
        })}
        <CreateButton basePath={basePath} />
       
        <ExportButton
            disabled={total === 0}
            resource={resource}
            sort={currentSort}
            filter={{ ...filterValues, ...permanentFilter }}
            exporter={exporter}
            maxResults={maxResults}
        />
        {/* Add your custom actions */}
        <Button
            onClick={() => { alert('Your custom action'); }}
            label="Show calendar"
        >
            <IconEvent />
        </Button>
    </TopToolbar>
);


const LeaveBulkActionButtons = props => (
    <Fragment>
        <ApproveBulkButton {...props} />
        <RejectBulkButton {...props} />
        <BulkDeleteButton {...props} />
        {/* <BulkExportButton {...props} /> */}
    </Fragment>
);

export const LeaveTransList = props => (
    <List {...props} actions={<ListActions />} bulkActionButtons={<LeaveBulkActionButtons/>}>
        <Datagrid rowClick="show">
            <ReferenceField source="employee_id" reference="employees">
                <TextField source="fullname" />
            </ReferenceField>
            <ReferenceField source="leave_type_id" reference="leave_type">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_trans_type_id" reference="leave_trans_type">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_trans_status_id" reference="leave_trans_status">
                <TextField source="name" />
            </ReferenceField>
            <DateField source="application_date" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            {/* <NumberField source="holiday_count"/>
            <NumberField source="previous_balance"/>
            <NumberField source="balance"/> */}
            <TextField source="is_approved" />
          
        </Datagrid>
    </List>
);


export const LeaveTransShow = (props) => (
    <Show title="LeaveTrans" {...props}>
       <SimpleShowLayout>
       <ReferenceField source="employee_id" reference="employees">
                <TextField source="fullname" />
            </ReferenceField>
            <ReferenceField source="leave_type_id" reference="leave_type">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_trans_type_id" reference="leave_trans_type">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField source="leave_trans_status_id" reference="leave_trans_status">
                <TextField source="name" />
            </ReferenceField>
            <TextField source="reason" />
            <DateField source="application_date" />
            <DateField source="start_date" />
            <DateField source="end_date" />
            <NumberField source="holiday_count"/>
            <NumberField source="previous_balance"/>
            <NumberField source="balance"/>
            <TextField source="is_approved" />
        </SimpleShowLayout>
    </Show>
);

export const LeaveTransCreate = (props) => (
    <Create title="Create a LeaveTrans" {...props}>
        <SimpleForm>
            <ReferenceInput label="Employee" source="employee_id" reference="employees">
                <SelectInput optionText="fullname" optionValue="id" />
            </ReferenceInput>
            
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Leave Trans Type" source="leave_trans_type_id" reference="leave_trans_type">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Leave Trans Status" source="leave_trans_status_id" reference="leave_trans_status">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="reason" />
            <DateInput source="application_date" />
            <DateInput source="start_date" />
            <DateInput source="end_date" />

           

        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>LeaveTrans {record ? `"${record.name}"` : ''}</span>;
};

const LeaveTransEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        {/* <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button> */}
    </TopToolbar>
);

export const LeaveTransEdit = (props) => (
    <Edit title={<PostTitle />} actions={<LeaveTransEditActions/>} {...props}>
        <SimpleForm>
            <ReferenceInput label="Employee" source="employee_id" reference="employees">
                <SelectInput optionText="fullname" optionValue="id" />
            </ReferenceInput>
            
            <ReferenceInput label="Leave Type" source="leave_type_id" reference="leave_type">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Leave Trans Type" source="leave_trans_type_id" reference="leave_trans_type">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <ReferenceInput label="Leave Trans Status" source="leave_trans_status_id" reference="leave_trans_status">
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>
            <TextInput source="reason" />
            <DateInput source="application_date" />
            <DateInput source="start_date" />
            <DateInput source="end_date" />

        </SimpleForm>
    </Edit>
);