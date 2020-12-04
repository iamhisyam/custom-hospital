export const validateCompanyCreation = (values) => {
    const errors = {};
    if (!values.name) {
        errors.name = ['The name is required'];
    }
    if (!values.address) {
        errors.address = ['The address is required'];
    } 
    if (!values.phone) {
        errors.phone = ['The phone is required'];
    } 
    if (!values.npwp) {
        errors.npwp = ['The npwp is required'];
    } 

    if (!values.city) {
        errors.city = ['The city is required'];
    } 

    if (!values.zip) {
        errors.zip = ['The zip is required'];
    } 


    if (!values.level) {
        errors.level = ['The level is required'];
    } 

    if (!values.npp) {
        errors.npp = ['The npp is required'];
    } 

    if (!values.kpa) {
        errors.kpa = ['The kpa is required'];
    } 

    if (!values.max_npwp) {
        errors.max_npwp = ['The max_npwp is required'];
    } 

    if (!values.kelurahan) {
        errors.kelurahan = ['The kelurahan is required'];
    } 

    if (!values.kecamatan) {
        errors.kecamatan = ['The kecamatan is required'];
    } 

    if (!values.klu) {
        errors.klu = ['The klu is required'];
    } 

    if (!values.fax) {
        errors.fax = ['The fax is required'];
    } 

    return errors
};