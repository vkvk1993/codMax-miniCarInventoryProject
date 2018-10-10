var rowCount = null;
$(function () {
    checkTableUpdated();
});

function checkTableUpdated() {
    $.ajax({
        type: 'post',
        url: 'monitorDatabase.php',
        data: '',
        dataType: "json",
        success: function (data) {
            if (rowCount != null) {
                if (rowCount.manufacturer > data.manufacturer) {
                    alert("Deleted Manufacturer.");
                } else if (rowCount.manufacturer < data.manufacturer) {
                    alert("Added Manufacturer.");
                }
                if (rowCount.model > data.model) {
                    alert("Deleted Model.");
                } else if (rowCount.model < data.model) {
                    alert("Added Model.");
                }
            }
            rowCount = data;
            setTimeout(checkTableUpdated, 6000);
        }
    });
}




function submitForm(formId, fileName) {
    $('#' + formId + '').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: fileName,
            dataType: "json",
            data: $('#' + formId + '').serialize(),
            success: function (data) {
                alert("Data Inserted Successfully");
                $('#' + formId + '')[0].reset();
                rowCount = data;
                location.reload(true);
            },
            error: function (jqXHR, exception) {
                alert("Filed to insert Data. "+exception);
            }
        });
    });
}

function getManufacturers() {
    var returnValue = "";
    $.ajax({
        type: 'post',
        async: false,
        url: "modelController.php?type=getManufacturersList",
        data: "",
        dataType: "json",
        success: function (data) {
            returnValue = data;
        }
    });
    return returnValue;
}

function updateButtonText(hiddenTextFieldId,buttonId, newText,selectedId) {
    $("#" + buttonId).html(newText);
    $("#" + buttonId).prop('value', selectedId);
    $("#" + hiddenTextFieldId).prop('value', selectedId);
}

function displayInventoryModal(rowId,modalId){
    var modal = $('#'+modalId);
    $.ajax({
        type: 'get',
        async: false,
        url: "viewInventoryController.php?type=getModelDetails&manufacturerId="+rowId,
        data: '',
        dataType: "json",
        success: function (data) {var models = jQuery.parseJSON(data.result);
            var tableRow ="";
            $.each(models, function(k,v) {
                tableRow+= '<tr>';
                tableRow+= '<td>'+v.color+'</td>';
                tableRow+= '<td>'+v.manufacturingYear+'</td>';
                tableRow+= '<td>'+v.note+'</td>';
                tableRow+= '<td>'+v.picturesNames+'</td>';
                tableRow+= '<td>'+v.registrationNumber+'</td>';
                tableRow+= '<td>'+v.modelName+'</td>';
                tableRow+= '<td><button type="button" id="'+v.modelID+'" name="'+v.modelID+'" onCLick="deleteModel(this.id,'+modalId+')" class="close" aria-label="Close" ><span aria-hidden="true">&times;</span></button></td>';
                tableRow+='</tr>';
            }); 
            modal.find('#modelModalBody').html(tableRow);
        },
        error: function (jqXHR, exception) {
            alert("Filed to fetch Data. "+exception);
        }
    });
}

function deleteModel(modelId,modalId){
    $.ajax({
        type: 'get',
        async: false,
        url: "viewInventoryController.php?type=deleteModel&modelId="+modelId,
        data: '',
        success: function (data) {
            returnValue = data;
            $('#'+modalId.id).modal('toggle');
            location.reload(true);
        },
        error: function (jqXHR, exception) {
            alert("Filed to Delete Data. "+exception);
        }
    });
}