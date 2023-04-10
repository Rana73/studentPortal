$("#registrationSave").validate({
    rules:{
        class:{
            required:true,
            maxlength:100
        },
        name:{
            required:true,
            maxlength:100
        },
        email:{
            required:true,
            maxlength:100
        },
        phone:{
            required:true,
            maxlength:11
        },
        status:{
            required:true,
        }
    },
    messages:{
        class:{
            required: "Please Type Class",
        },
        name:{
            required: "Please Type Name",
        },
        email:{
            required: "Please Type Email",
        },
        phone:{
            required: "Please Type Phone",
        },
        status:{
            required: "Please Select Status",
        },
    }
});

