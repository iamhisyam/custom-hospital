// in src/Foo.js
import React, { useState, useEffect,useRef} from 'react';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';
import Container from '@material-ui/core/Container';

import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

import ReactToPrint from 'react-to-print';

import { withStyles } from '@material-ui/core/styles';



import { Title, 
    useDataProvider,
    Loading,
    Error,

} from 'react-admin';


const useStyles = theme =>({
        table: {
          minWidth: 650,
        },
      });



class MedicalReport extends React.Component{



    render(){
        const {classes} = this.props
        const LabResultView =[];
        const {arrayData} = this.props;
       
        let idKey = 0;

        arrayData.length > 0 && arrayData.labs_result.forEach((lab_result,id)=>{
    
            lab_result.labs_test.forEach((lab_test,idlt)=>{
                if(idlt===0){
                    LabResultView.push(
                        <TableRow key={idKey+"head"}>
                            <TableCell ><b>{lab_result.lab.name}</b></TableCell>
                            <TableCell ></TableCell>
                            <TableCell ></TableCell>
                            <TableCell ></TableCell>
                            <TableCell ></TableCell>                                                                       
                    </TableRow>)
                }
    
                LabResultView.push(
                    <TableRow key={idKey+""}>
                        <TableCell >{lab_test.name}</TableCell>
                        <TableCell >{lab_test.value}</TableCell>
                        <TableCell >{lab_test.measure}</TableCell>
                        <TableCell >{lab_test.normal_condition}</TableCell>
                        <TableCell ></TableCell>                                                                       
                </TableRow>
                )
                idKey++;
            })
        }) 
    
        return (
           
            <Card>
                <Title title="Medical Report" />
                <CardContent>
                <Typography variant="h4" component="h4" gutterBottom>
                    Hospital Medical Report
                </Typography>
                <Typography variant="body1" component="p" gutterBottom>
                    This form is to be completed by the patient's hospital doctor
                </Typography>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    Private and Confidential
                </Typography>
                <TableContainer component={Paper}>
                <Table className={classes.table} aria-label="simple table">
                    <TableHead>
                    <TableRow>
                        <TableCell colSpan={2}> Patient's Name : {arrayData.patient && arrayData.patient.name } </TableCell>
                        <TableCell >No REG : {arrayData.id} </TableCell>
                        <TableCell >Checkup at : {arrayData.checkup_at}</TableCell>
                    </TableRow>
                    </TableHead>
                  
                </Table>
                </TableContainer>
    
                <br />
                <br />
                <Typography variant="h5" component="h5" gutterBottom>
                    Identity
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">
                   
                    <TableBody>
                    <TableRow>
                        <TableCell>No Reg </TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.code }</TableCell> 
                        <TableCell>Checkup No</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.id }</TableCell>                                      
                    </TableRow>
                    <TableRow>
                        <TableCell>Name </TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.name }</TableCell>  
                        <TableCell>Checkup at </TableCell>
                        <TableCell >{arrayData.checkup_at  }</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell>Company</TableCell>
                        <TableCell ></TableCell>    
                        <TableCell>Provider</TableCell>
                        <TableCell ></TableCell>                  
                    </TableRow> 
                    
                    </TableBody>
                </Table>
                </TableContainer>
                <br />
                <br />
                <Typography variant="h5" component="h5" gutterBottom>
                    Result of Medical Checkup Year (YEAR)
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">
                   
                    <TableBody>
                    <TableRow>
                        <TableCell>No Patient </TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.code }</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell>Name </TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.name }</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell>Date of Birth </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Sex</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.sex }</TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Address </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Phone</TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Company </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Department </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Role </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    <TableRow>
                        <TableCell>Medical Checkup Type </TableCell>
                        <TableCell ></TableCell>                    
                    </TableRow> 
                    </TableBody>
                </Table>
                </TableContainer>
                <br />
                <br />
                <Typography variant="h5" component="h5" gutterBottom>
                    ANAMNESA
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">
                   
                    <TableBody>
                    <TableRow>
                        <TableCell colSpan={2}> <b>RIWAYAT PENYAKIT DAHULU</b></TableCell>
                                                
                    </TableRow>
                    <TableRow>
                        <TableCell>Penyakit yang pernah diderita</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.being_sick && "Ya" || "Tidak"  }</TableCell>                             
                    </TableRow>
                    <TableRow>
                        <TableCell>Pernah dirawat di RS </TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.ever_had_treated && "Ya" || "Tidak"  }</TableCell> 
                                                           
                    </TableRow>
                    <TableRow>
                        <TableCell>Apakah pernah menajalani operasi</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.ever_had_surgery && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Apakah pernah mengalami kecelakan</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.ever_had_accident && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell colSpan={2}> <b>KEBIASAAN</b></TableCell>                           
                    </TableRow>
                    <TableRow>
                        <TableCell>Merokok</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.smoking_habit && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Alkohol</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.alcohol_habit && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Kopi</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.coffe_habit && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Olahraga</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.exercise_habit && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell colSpan={2}> <b>RIWAYAT PENYAKIT</b></TableCell>                           
                    </TableRow>
                    <TableRow>
                        <TableCell>Hipertensi/Darah Tinggi</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_hypertension && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Diabetes Militus/Kencing Manis</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_diabetes && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Sakit Jantung</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_heart_disease && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow> 
                    <TableRow>
                        <TableCell>Sakit Ginjal</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_kidney_disease && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow>
                    <TableRow>
                        <TableCell>Gangguan Mental</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_mentally_ill && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow>
                    <TableRow>
                        <TableCell>Lain-lain (Asthma)</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.had_mentally_ill && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow>
                    <TableRow>
                        <TableCell colSpan={2}> <b>RIWAYAT PENYAKIT SEKARANG</b></TableCell>                           
                    </TableRow>
                    <TableRow>
                        <TableCell>Apakah sedang menderita suatu penyakit</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.being_sick && "Ya" || "Tidak"  }</TableCell>                        
                    </TableRow>
                    <TableRow>
                        <TableCell>Penyakit apa</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.sickness || ""  }</TableCell>                        
                    </TableRow>
                    <TableRow>
                        <TableCell>Sudah berapa lama</TableCell>
                        <TableCell >{arrayData.patient && arrayData.patient.long_being_sick || ""  }</TableCell>                        
                    </TableRow> 
                    </TableBody>
                </Table>
                </TableContainer>
                <br/>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    PEMERIKSAAN FISIK
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">
                   
                    <TableBody>
                    <TableRow>
                        <TableCell width={5}>1</TableCell>
                        <TableCell colSpan={2}><b>KEADAAN UMUM</b></TableCell> 
                                                            
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Tinggi Badan</TableCell>  
                        <TableCell>{arrayData.height  }</TableCell>
                        <TableCell >cm</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Berat Badan</TableCell>  
                        <TableCell>{arrayData.weight  }</TableCell>
                        <TableCell >Kg</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Anjuran Berat Badan</TableCell>  
                        <TableCell>{arrayData.ideal_weight  }</TableCell>
                        <TableCell >Kg</TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >BMI</TableCell>  
                        <TableCell>{arrayData.bmi  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Kondisi Nutrisi</TableCell>  
                        <TableCell>{arrayData.nutrition_stat  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Kulit</TableCell>  
                        <TableCell>{arrayData.skin  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>2</TableCell>
                        <TableCell colSpan={2}><b>MATA</b></TableCell>                                                    
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Visus Kiri</TableCell>  
                        <TableCell>{arrayData.left_vision  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Visus kanan</TableCell>  
                        <TableCell>{arrayData.right_vision  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Konjungtiva</TableCell>  
                        <TableCell>{arrayData.conjungtiva  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Skelera</TableCell>  
                        <TableCell>{arrayData.sclera  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Pupil</TableCell>  
                        <TableCell>{arrayData.pupil  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Buta Warna</TableCell>  
                        <TableCell>{arrayData.color_blind  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Bola Mata</TableCell>  
                        <TableCell>{arrayData.eye_ball  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Kornea</TableCell>  
                        <TableCell>{arrayData.cornea  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>3</TableCell>
                        <TableCell colSpan={2}><b>TELINGA</b></TableCell>                                                    
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Telinga luar</TableCell>  
                        <TableCell>{arrayData.outer_ear  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>4</TableCell>
                        <TableCell colSpan={2}><b>HIDUNG,MULUT,LEHER</b></TableCell>                                                    
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Hidung</TableCell>  
                        <TableCell>{arrayData.nose  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Lidah</TableCell>  
                        <TableCell>{arrayData.tongue  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Gigi Atas</TableCell>  
                        <TableCell>{arrayData.upper_teeth  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Gigi Bawah</TableCell>  
                        <TableCell>{arrayData.lower_teeth  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Pharing</TableCell>  
                        <TableCell>{arrayData.pharing  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Tonsil</TableCell>  
                        <TableCell>{arrayData.tonsil  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>4</TableCell>
                        <TableCell colSpan={2}><b>SISTEM KARDIOVASKULER</b></TableCell>                                                    
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Tekanan Darah</TableCell>  
                        <TableCell>{arrayData.blood_pressure  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Denyut Nadi</TableCell>  
                        <TableCell>{arrayData.pulse  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Irama</TableCell>  
                        <TableCell>{arrayData.rhythm  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>6</TableCell>
                        <TableCell colSpan={2}><b>SISTEM PERNAPASAN</b></TableCell>                                                    
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Frekuensi</TableCell>  
                        <TableCell>{arrayData.frequency  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Paru-paru</TableCell>  
                        <TableCell>{arrayData.lung  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Vesikuler</TableCell>  
                        <TableCell>{arrayData.vesiculer  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Ronchi</TableCell>  
                        <TableCell>{arrayData.ronchi  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell> </TableCell>
                        <TableCell >Wheezing</TableCell>  
                        <TableCell>{arrayData.wheezing  }</TableCell>
                        <TableCell ></TableCell>                                     
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>7</TableCell>
                        <TableCell ><b>EKG</b></TableCell>  
                        <TableCell >{arrayData.ekg  }</TableCell>                                                  
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>8</TableCell>
                        <TableCell ><b>AUDIO TEST</b></TableCell>  
                        <TableCell >{arrayData.audio_test  }</TableCell>                                                  
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>9</TableCell>
                        <TableCell ><b>USG</b></TableCell>  
                        <TableCell >{arrayData.usg  }</TableCell>                                                  
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>9</TableCell>
                        <TableCell ><b>TREADMILL</b></TableCell>  
                        <TableCell >{arrayData.treadmill  }</TableCell>                                                  
                    </TableRow>
                    </TableBody>
                </Table>
                </TableContainer>
                <br/>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    KESIMPULAN
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">              
                    <TableBody>
                    <TableRow>
                        <TableCell width={5}>-</TableCell>
                        <TableCell><b>Pemeriksaan Fisik</b></TableCell> 
                        <TableCell></TableCell>                                                   
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>-</TableCell>
                        <TableCell><b>Laboratorium</b></TableCell> 
                        <TableCell></TableCell>                                                       
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>-</TableCell>
                        <TableCell ><b>Radiologi</b></TableCell> 
                        <TableCell ></TableCell>                                                        
                    </TableRow>
                    <TableRow>
                        <TableCell width={5}>-</TableCell>
                        <TableCell ><b>Spirometri</b></TableCell> 
                        <TableCell ></TableCell>                                                       
                    </TableRow>
                    </TableBody>
                </Table>
                </TableContainer>
                <br/>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    SARAN DAN ANJURAN
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">
                   
                    <TableBody>
                    <TableRow>
                        <TableCell ><b>Saran dan anjuran</b></TableCell>
                        <TableCell ></TableCell> 
                        
                                                            
                    </TableRow>
                    
                    </TableBody>
                </Table>
                </TableContainer>
                <br/>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    HASIL
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">             
                    <TableBody>
                    <TableRow>
                        <TableCell><b>FIT/UNFIT</b></TableCell>
                        <TableCell></TableCell>                                                                         
                    </TableRow>
                    
                    </TableBody>
                </Table>
                </TableContainer>
                <br/>
                <br/>
                <Typography variant="h5" component="h5" gutterBottom>
                    HASIL UJI LAB
                </Typography>
                <TableContainer component={Paper} >
                <Table className={classes.table} size="small" aria-label="simple table">             
                <TableHead>
                    <TableRow>
                        <TableCell >PEMERIKSAAN</TableCell>
                        <TableCell >HASIL</TableCell>
                        <TableCell >SATUAN</TableCell>
                        <TableCell >NORMAL</TableCell>
                        <TableCell >KETERANGAN</TableCell>
                    </TableRow>
                    </TableHead>
                    <TableBody>
                    {
                        LabResultView && LabResultView || null
                    }
                    </TableBody>
                    
                    
                </Table>
                </TableContainer>
                </CardContent>
            </Card>)
    }
}

    // const classes = useStyles();
    // const {id} = props.match.params

    // const dataProvider = useDataProvider();
    // const [arrayData, setArrayData] = useState();
    // const [loading, setLoading] = useState(true);
    // const [error, setError] = useState();
    
    // useEffect(() => {
    //     dataProvider.getOne('medical_checkups',{id:id}).then(({ data }) => {
    //             console.log(data)
    //             setArrayData(data)
                
    //             setLoading(false);
    //         })
    //         .catch(error => {
    //             setError(error);
    //             setLoading(false);
    //         })
    // }, []);

    
const CompRoot = withStyles(useStyles)(MedicalReport)

const MedicalReportDetail = (props) => {
    const componentRef = useRef();
    const {id} = props.match.params

    const dataProvider = useDataProvider();
    const [arrayData, setArrayData] = useState();
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState();
    const LabResultView =[];
    useEffect(() => {
        dataProvider.getOne('medical_checkups',{id:id}).then(({ data }) => {
                console.log(data)
                setArrayData(data)
                
                setLoading(false);
            })
            .catch(error => {
                setError(error);
                setLoading(false);
            })
    }, []);

    if (loading) return <Loading />;
    if (error) return <Error />;


        return (
            <Container>
                <ReactToPrint 
                    trigger={()=><button>Print</button>}
                    content={()=>componentRef.current}
                />
                <CompRoot ref={componentRef} arrayData={arrayData} {...props}/>
            </Container>
        )
    }

export default MedicalReportDetail;