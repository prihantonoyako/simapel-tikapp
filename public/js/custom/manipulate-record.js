function delete_record(url = null, id = null, flag = false) {
    const xhttp = new XMLHttpRequest();
    let jobStatus = xhttp.onreadystatechange = function () {
        let jobDone = false;        
        switch (this.readyState) {
            case 4:
                switch (this.status) {                    
                    case 200:                      
                        swal({
                            title: 'SUCCESS',
                            text: JSON.parse(this.responseText).message,
                            type: 'success',
                            confirmButtonClass: "btn green",
                            buttonsStyling: false
                        })
                        jobDone = true;
                        break;
                    case 500:
                        swal({
                            title:'FAILED',
                            text:JSON.parse(this.responseText).message,
                            type:'error',
                            confirmButtonClass:'btn red'
                        })
                        break;
                }
                break;
        }
        return jobDone;
    }
    let data = "id="+id+'&permanent='+flag;
    xhttp.open('POST', url);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhttp.send(data);

    return jobStatus;
}

function restore_record(url = null, id = null) {
    const xhttp = new XMLHttpRequest();
    let jobStatus = xhttp.onreadystatechange = function () {
        let jobDone = false;        
        switch (this.readyState) {
            case 4:
                switch (this.status) {                    
                    case 200:                    
                        swal({
                            title: 'SUCCESS',
                            text: JSON.parse(this.responseText).message,
                            type: 'success',
                            confirmButtonClass: "btn green",
                            buttonsStyling: false
                        })
                        jobDone = true;
                       break;
                    case 500:
                        swal({
                            title:'FAILED',
                            text:JSON.parse(this.responseText).message,
                            type:'error',
                            confirmButtonClass:'btn red'
                        })
                        break;
                }
                break;
        }
        return jobDone;
    }
    let data = "id="+id;
    xhttp.open('POST', url);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhttp.send(JSON.stringify(data));

    return jobStatus;
}