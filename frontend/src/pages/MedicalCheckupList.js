// in src/pages/CategoryList.js
import React from 'react';
import {Link} from 'react-router-dom'
import {
    List, 
    Datagrid, 
    TextField,
    
    DateField, 
    NumberField,
    ReferenceField, 
    SimpleForm, 
    Create, 
    Edit, 
    TextInput, 
    DateInput, 
    NumberInput,
    ReferenceInput,
    BooleanInput,
    SelectInput ,
    TabbedForm, 
    FormTab,
    Show,
    SimpleShowLayout,
    TabbedShowLayout, 
    Tab,
    required,
    CardActions,
    ShowButton,
    EditButton,
    

} from 'react-admin';
import Button from '@material-ui/core/Button';
import AssignmentIcon from '@material-ui/icons/Assignment';

const MedicalCheckupShowActions = ({ basePath, data, resource }) => (
    <CardActions>
        <ShowButton basePath={basePath} record={data} />
        <EditButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
       

        <Button  component={Link} to={{pathname:`/medicalreport/${data.id}`}} color="primary" onClick={()=>console.log(data)}
            size="small"
        startIcon={<AssignmentIcon/>}
        
        >Report</Button>
       
    
    
        
    </CardActions>
);


//import {validateMedicalCheckupCreation} from '../validations/MedicalCheckupValidation'

export const MedicalCheckupList = props => (
    <List {...props}>
        <Datagrid rowClick="show">

            <ReferenceField label="Patient" source="patient_id" reference="patients" link="show" allowEmpty={true}>
                    <TextField source="name" />
                </ReferenceField>
            <DateField source="checkup_at" />
            <TextField  source="conclusion" />  
            <TextField source="address" />
            
          
        </Datagrid>
    </List>
);


export const MedicalCheckupCreate = (props) => (
    <Create title="Create a MedicalCheckup" {...props}>
       <TabbedForm >
       <FormTab label="general">
                {/* <TextInput source="name" />
                <TextInput source="code" />
                <TextInput source="provider" /> */}
                <ReferenceInput label="Patient" source="patient_id" reference="patients" link="show" allowEmpty={true}>
                    <SelectInput optionText="name" optionValue="id" validate={[required()]} />  
                </ReferenceInput>
                <ReferenceInput label="Provider" source="company_id" reference="companies" link="show" allowEmpty={true}>
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
                
                <DateInput source="checkup_at" validate={[required()]} />
      
                <NumberInput source="height" />
                <NumberInput source="weight" />
                <NumberInput source="ideal_weight" />
                <NumberInput source="bmi" />
                <TextInput source="nutrition_stat" />
                <NumberInput source="skin" />

                <TextInput multiline source="conclusion" />  
                
            </FormTab>
            <FormTab label="eyes">
                <TextInput source="left_vision" />
                <TextInput source="right_vision" />
                <TextInput source="conjungtiva" />
                <TextInput source="sclera" />
                <TextInput source="pupil" />
                <TextInput source="color_blind" />
                <TextInput source="eye_ball" />
                <TextInput source="cornea" />
                
            </FormTab>
            <FormTab label="ear">
                <TextInput source="outer_ear" />           
            </FormTab>
            <FormTab label="nose, mouth, neck">
                <TextInput source="nose" />           
                <TextInput source="tongue" />           
                <TextInput source="upper_teeth" />           
                <TextInput source="lower_teeth" />           
                <TextInput source="pharing" />           
                <TextInput source="tonsil" />           
            </FormTab>
            <FormTab label="kardiovaskuler">
                <TextInput source="blood_pressure" />           
                <TextInput source="pulse" />           
                <TextInput source="rhythm" />                    
            </FormTab>
            <FormTab label="respiration">
                <TextInput source="frequency" />           
                <TextInput source="lung" />           
                <TextInput source="vesiculer" />                    
                <TextInput source="ronchi" />                    
                <TextInput source="wheezing" />                    
            </FormTab>
            <FormTab label="other">
                <TextInput source="ekg" />           
                <TextInput source="audio_test" />           
                <TextInput source="usg" />                    
                <TextInput source="treadmill" />                                      
            </FormTab>
           
        </TabbedForm>
    </Create>
);

const PostTitle = ({ record }) => {
    return <span>Post {record ? `"${record.name}"` : ''}</span>;
};
export const MedicalCheckupEdit = (props) => (
    <Edit title={<PostTitle />} {...props}>
       <TabbedForm >
       <FormTab label="general">
                {/* <TextInput source="name" />
                <TextInput source="code" />
                <TextInput source="provider" /> */}
                <ReferenceInput label="Patient" source="patient_id" reference="patients" link="show" allowEmpty={true}>
                    <SelectInput optionText="name" optionValue="id" />  
                </ReferenceInput>
                <ReferenceInput label="Provider" source="company_id" reference="companies" link="show" allowEmpty={true}>
                    <SelectInput optionText="name" optionValue="id" />
                </ReferenceInput>
                
                <DateInput source="checkup_at" />
      
                <NumberInput source="height" />
                <NumberInput source="weight" />
                <NumberInput source="ideal_weight" />
                <NumberInput source="bmi" />
                <TextInput source="nutrition_stat" />
                <NumberInput source="skin" />

                <TextInput multiline source="conclusion" />  
                
            </FormTab>
            <FormTab label="eyes">
                <TextInput source="left_vision" />
                <TextInput source="right_vision" />
                <TextInput source="conjungtiva" />
                <TextInput source="sclera" />
                <TextInput source="pupil" />
                <TextInput source="color_blind" />
                <TextInput source="eye_ball" />
                <TextInput source="cornea" />
                
            </FormTab>
            <FormTab label="ear">
                <TextInput source="outer_ear" />           
            </FormTab>
            <FormTab label="nose, mouth, neck">
                <TextInput source="nose" />           
                <TextInput source="tongue" />           
                <TextInput source="upper_teeth" />           
                <TextInput source="lower_teeth" />           
                <TextInput source="pharing" />           
                <TextInput source="tonsil" />           
            </FormTab>
            <FormTab label="kardiovaskuler">
                <TextInput source="blood_pressure" />           
                <TextInput source="pulse" />           
                <TextInput source="rhythm" />                    
            </FormTab>
            <FormTab label="respiration">
                <TextInput source="frequency" />           
                <TextInput source="lung" />           
                <TextInput source="vesiculer" />                    
                <TextInput source="ronchi" />                    
                <TextInput source="wheezing" />                    
            </FormTab>
            <FormTab label="other">
                <TextInput source="ekg" />           
                <TextInput source="audio_test" />           
                <TextInput source="usg" />                    
                <TextInput source="treadmill" />                                      
            </FormTab>
           
        </TabbedForm>
    </Edit>
);

export const MedicalCheckupShow = (props) => (
<Show title="MedicalCheckup" actions={<MedicalCheckupShowActions/>} {...props}>
       <TabbedShowLayout>
       <Tab label="general">
                {/* <TextField source="name" />
                <TextField source="code" /> */}
                {/* <TextField source="provider" /> */}
                <ReferenceField label="Patient" source="patient_id" reference="patients" link="show" allowEmpty={true}>
                    <TextField source="name" />
                </ReferenceField>
                <ReferenceField label="Provider" source="company_id" reference="companies" link="show" allowEmpty={true}>
                    <TextField source="name" />
                </ReferenceField>
                
                <DateField source="checkup_at" />
            
                <NumberField source="height" />
                <NumberField source="weight" />
                <NumberField source="ideal_weight" />
                <NumberField source="bmi" />
                <TextField source="nutrition_stat" />
                <NumberField source="skin" />

                <TextField  source="conclusion" />     

                
            </Tab>
            <Tab label="eyes">
                <TextField source="left_vision" />
                <TextField source="right_vision" />
                <TextField source="conjungtiva" />
                <TextField source="sclera" />
                <TextField source="pupil" />
                <TextField source="color_blind" />
                <TextField source="eye_ball" />
                <TextField source="cornea" />
                
            </Tab>
            <Tab label="ear">
                <TextField source="outer_ear" />           
            </Tab>
            <Tab label="nose, mouth, neck">
                <TextField source="nose" />           
                <TextField source="tongue" />           
                <TextField source="upper_teeth" />           
                <TextField source="lower_teeth" />           
                <TextField source="pharing" />           
                <TextField source="tonsil" />           
            </Tab>
            <Tab label="kardiovaskuler">
                <TextField source="blood_pressure" />           
                <TextField source="pulse" />           
                <TextField source="rhythm" />                    
            </Tab>
            <Tab label="respiration">
                <TextField source="frequency" />           
                <TextField source="lung" />           
                <TextField source="vesiculer" />                    
                <TextField source="ronchi" />                    
                <TextField source="wheezing" />                    
            </Tab>
            <Tab label="other">
                <TextField source="ekg" />           
                <TextField source="audio_test" />           
                <TextField source="usg" />                    
                <TextField source="treadmill" />                                      
            </Tab>
           
            
        </TabbedShowLayout>
    </Show>
);