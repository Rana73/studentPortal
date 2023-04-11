$("#registrationUpdate").validate({
    rules:{
        name:{
            required:true,
            maxlength:70
        },
        email:{
            required:true,
            maxlength:70
        },
        division:{
            required:true,
        },
        district:{
            required:true,
        },
        upazila:{
            required:true,
        },
        address:{
            required:true,
        },
        'exam[]':{
            required:true,
        },
        'university[]':{
            required:true,
        },
        'board[]':{
            required:true,
        },
        'result[]':{
            required:true,
            maxlength:30
        },
        image:{
            extension: "jpg|jpeg|png",
        },
        cv:{
            extension: "pdf|doc",
        },
        'training_name[]':{
            required: true,
        },
        'training_details[]':{
            required: true,
        },
    },
    messages:{
        name:{
            required: "Please Enter Your Name",
        },
        email:{
            required: "Please Enter Your Email",
        },
        division:{
            required: "Please Select Division",
        },
        district:{
            required: "Please Select District",
        },
        upazila:{
            required: "Please Select Upazila",
        },
        address:{
            required: "Please Enter Your Address",
        },
        'exam[]':{
            required: "Please Select Exam",
        },
        'university[]':{
            required: "Please Select University",
        },
        'board[]':{
            required: "Select Board",
        },
        'result[]':{
            required: "Please Enter Result",
        },
        image:{
            extension: "Only jpg, jpeg, png file are Allowed",
        },
        cv:{
            extension: "Only Pdf, doc file are Allowed",
        },
        'training_name[]':{
            required: "Please Enter Training Name",
        },
        'training_details[]':{
            required: "Please Enter Training Details",
        },
    }
});
