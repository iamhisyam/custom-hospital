// in src/pages/CategoryList.js
import React,{Fragment, useState, useEffect} from 'react';
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
    SimpleShowLayout,
    ArrayInput, 
    SimpleFormIterator,
    FormDataConsumer,
    Loading,
    Error,
    useDataProvider,
    useTranslate,
    useRefresh
    
  

} from 'react-admin';
import Button from '@material-ui/core/Button';
import { makeStyles, Theme } from '@material-ui/core/styles';
import { Typography, Box } from '@material-ui/core';

import {useForm} from 'react-final-form'

const SectionTitle = ({ label }) => {
    const translate = useTranslate();

    return (
        <Typography variant="h6" gutterBottom>
            {/* {translate(label)} */}
            {label}
        </Typography>
    );
};

const Separator = () => <Box pt="1em" />;

export const styles = {
    label: { display: 'inline-block',marginRight:5 },
    inlineInput: { display: 'inline-block'},
    email: { width: 544 },
    address: { maxWidth: 544 },
    zipcode: { display: 'inline-block' },
    city: { display: 'inline-block', marginLeft: 32 },
    comment: {
        maxWidth: '20em',
        overflow: 'hidden',
        textOverflow: 'ellipsis',
        whiteSpace: 'nowrap',
    },
    password: { display: 'inline-block' },
    confirm_password: { display: 'inline-block', marginLeft: 32 },
};

const useStyles = makeStyles(styles);


export const LabResultList = props => (
    <List {...props}>
        <Datagrid rowClick="show">
            <TextField source="id" />
            <ReferenceField label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={false}>
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Medical Checkup" source="medical_checkup_id" reference="medical_checkups" link="show" allowEmpty={true}>
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Patient" source="patient_id" reference="patients" link="show" allowEmpty={false}>
                <TextField source="name" />
            </ReferenceField>

            <DateField source="created_at" />
            <DateField source="updated_at" />
          
        </Datagrid>
    </List>
);


export const LabResultShow = (props) => (
    <Show title="LabResult" {...props}>
       <SimpleShowLayout>
            <TextField source="id" />
            <ReferenceField label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <TextField optionText="name" optionValue="id" />
            </ReferenceField>
            <TextField source="name" />
            <TextField source="measure" />
        </SimpleShowLayout>
    </Show>
);

const LabValueInput = ({lab_id, arrayData, ...rest}) => {
    const classes = useStyles();
    console.log(arrayData)
    
    //return arrayData.map((item,id)=><p key={id+""}>{item.name}</p>)
    return  (
        
        <ArrayInput source="labs_test" defaultValue={arrayData} {...rest} label=""  >
            <SimpleFormIterator 
            //mutators={{setMin:(args,state,utils)=>{console.log(state)}}} 
            //defaultValue={arrayData}
            disableRemove disableAdd >
                <FormDataConsumer key={arrayData.toString()}>
                    {({getSource,scopedFormData,formData})=>{
                       // console.log(formData)
                        getSource();
                        return(
                            <div>
                                <TextField className={classes.label} source={"name"} record={scopedFormData} /> 
                                <TextField className={classes.label} source={"measure"} record={scopedFormData } />             
                            </div>
                        )
                    }}
                </FormDataConsumer>
                <TextInput className={classes.inlineInput} source={"value"} label="value" />
                
                
            </SimpleFormIterator>
        </ArrayInput>
        
    )
  
}

const LabResult = ({ lab_id, ...rest }) => {
    
        const dataProvider = useDataProvider();
        const [arrayData, setArrayData] = useState();
        const [loading, setLoading] = useState(true);
        const [error, setError] = useState();
  
        const form = useForm()
   
        
        
        

        useEffect(() => {
          
            dataProvider.getList('labs_setup', 
            {
                pagination :{ page:1,perPage:100},
                sort: {field:'id',order:'asc'},
                filter : {lab_id}
            }).then(({ data }) => {
                   setArrayData(data)
                    setLoading(false);
                    form.change('labs_test',data);
                   
                })
                .catch(error => {
                    setError(error);
                    setLoading(false);
                })
        }, [lab_id]);

        if (loading) return <Loading />;
        if (error) return <Error />;
        
        //console.log(arrayData);
    return (
         <Fragment >
            <SectionTitle label="Test Details" />
            <LabValueInput   {...rest} arrayData={arrayData}/>
        </Fragment> 
    );
};

export const LabResultCreate = (props) => {
    const refresh = useRefresh()
   
    return (
    <Create title="Create a LabResult" {...props}>
        <SimpleForm >
            <SectionTitle label="Lab Result" />
            <ReferenceInput label="Medical Checkup" source="medical_checkup_id" reference="medical_checkups" link="show" allowEmpty={true}>
                <SelectInput optionText={(mc)=>mc.patient.name+" ("+mc.checkup_at+")"} optionValue="id" />
            </ReferenceInput> 
            <ReferenceInput label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <SelectInput optionText="name" optionValue="id" onChange={(v)=>{ }}/>
            </ReferenceInput> 
           
            <FormDataConsumer>
                {({ formData, ...rest }) =>  {
                    if(formData.medical_checkup_id && formData.lab_id) {
                        //console.log(formData.lab_id);
                       

                        return <LabResult key={formData.lab_id+""} lab_id={formData.lab_id} {...rest}  />
                    }

                    return null;
                    
                }}
          
            </FormDataConsumer>
              
        </SimpleForm>
    </Create>
)};

const PostTitle = ({ record }) => {
   
    return <span>LabResult {record ? `"${record.id}"` : ''}</span>;
};

const LabResultEditActions = ({ basePath, data, resource }) => (
    <TopToolbar>
        <ShowButton basePath={basePath} record={data} />
        {/* Add your custom actions */}
        <Button color="primary" onClick={(()=>console.log(data))}>Custom Action</Button>
    </TopToolbar>
);

export const LabResultEdit = (props) => {
    const classes = useStyles();
    return(
    <Edit title={<PostTitle />} actions={<LabResultEditActions/>} {...props}>
        <SimpleForm>
            <ReferenceInput label="Medical Checkup" source="medical_checkup_id" reference="medical_checkups" link="show" allowEmpty={true}>
                <SelectInput optionText={(mc)=>mc.patient.name+" ("+mc.checkup_at+")"} optionValue="id" />
            </ReferenceInput> 
            <ReferenceInput label="Lab" source="lab_id" reference="labs" link="show" allowEmpty={true}>
                <SelectInput optionText="name" optionValue="id" />
            </ReferenceInput>  
                           
            <ArrayInput source="labs_test">
                <SimpleFormIterator disableRemove disableAdd >
                    {/* <TextInput source="name" options={{disabled:true}} label="test" />
                    <TextInput source={"value"} label="value" /> */}
                    <FormDataConsumer >
                    {({getSource,scopedFormData})=>{
                        getSource();
                        return(
                            <div>
                                <TextField className={classes.label} source={"name"} record={scopedFormData} /> 
                                <TextField className={classes.label} source={"measure"} record={scopedFormData } />             
                            </div>
                        )
                    }}
                </FormDataConsumer>
                <TextInput source={"value"} label="value" />
                </SimpleFormIterator>
            </ArrayInput>
        </SimpleForm>
    </Edit>
)};