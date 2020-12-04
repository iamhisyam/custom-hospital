// in src/pages/CategoryList.js
import React,{Fragment} from 'react';
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
    BooleanInput,
    SelectInput ,
    TopToolbar,
    ShowButton,
    Show,
    SimpleShowLayout,
    FormDataConsumer

} from 'react-admin';
import Button from '@material-ui/core/Button';


export const LeaveBalanceList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            
            <ReferenceField source="employee_id" reference="employees">
                <TextField source="fullname" />
            </ReferenceField>
        
            <TextField source="year" />
            <TextField source="month" />
            <NumberField source="days" />
            <DateField source="valid_at" />
            <DateField source="expired_at" />
          
        </Datagrid>
    </List>
);


export const LeaveBalanceShow = (props) => (
    <Show title="LeaveBalance" {...props}>
       <SimpleShowLayout>
        <ReferenceField source="employee_id" reference="employees">
                <TextField source="fullname" />
            </ReferenceField>
        
            <TextField source="year" />
            <TextField source="month" />
            <NumberField source="days" />
            <DateField source="valid_at" />
            <DateField source="expired_at" />
        </SimpleShowLayout>
    </Show>
);

export const LeaveBalanceCreate = (props) => (
    <Create title="Create a LeaveBalance" {...props}>
        <SimpleForm redirect="list">
            <BooleanInput source="bulk_input"  />

            <FormDataConsumer>
                 {({ formData, ...rest }) => !formData.bulk_input &&  
                    //   <TextInput source="email" {...rest} />
                    <Fragment>
                      <ReferenceInput label="Leave Setup" source="leave_setup_id" reference="leave_setup" {...rest} >
                            <SelectInput optionText="name" optionValue="id" />
                      </ReferenceInput><br/>
                      <ReferenceInput label="Employee" source="employee_id" reference="employees" {...rest} >
                            <SelectInput optionText="fullname" optionValue="id" />
                      </ReferenceInput><br/>
                      {/* <NumberInput source="month" label="Days Off" /><br/> */}
                      
                    </Fragment>
                    || 
                    <Fragment>
                      <ReferenceInput label="Leave Setup" source="leave_setup_id" reference="leave_setup" {...rest} >
                            <SelectInput optionText="name" optionValue="id" />
                      </ReferenceInput><br/>
                      {/* <NumberInput source="month" label="Month" /><br/> */}
                    
                      
                    </Fragment>

                 }
             </FormDataConsumer>
            
            
           
            
            

        </SimpleForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>LeaveBalance {record ? `"${record.name}"` : ''}</span>;
};

const LeaveBalanceEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const LeaveBalanceEdit = (props) => (
    <Edit title={<PostTitle />} actions={<LeaveBalanceEditActions/>} {...props}>
        <SimpleForm>
            <ReferenceInput label="Employee" source="employee_id" reference="employees">
                <SelectInput optionText="fullname" optionValue="id" />
            </ReferenceInput>
            
            <NumberInput source="days" />
            <TextField source="year" />
            <TextField source="month" />
            
            <TextField source="expire_count" />

        </SimpleForm>
    </Edit>
);