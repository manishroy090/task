
import * as Yup from 'yup';
export const clientSchema = Yup.object({
    name:Yup.string().required("Name is required"),
    email:Yup.string().email().required("Email is required"),
    address:Yup.string().required("Address is required"),
    nationality:Yup.string().required("Nationality is required"),
    gender:Yup.string().required("Gender is required"),
    phone:Yup.string().required("Phone is required"),
    dob:Yup.date().required("Date of birth is required"),
    education:Yup.string().required("Education is required"),
    contactmode:Yup.string().required("Contact mode is required")

})