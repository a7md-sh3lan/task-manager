function handleChange(checkbox) {
    fetch('/tasks/toggle', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'task_id' : checkbox.value
        })
    })
    .then(response => {
        if(response.ok) {
            return response.json();
        }
        throw new Error('Something went wrong');
    })
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        console.error(error);
        alert('Error! Try again or Check your data..');
    });
}



$(document).ready(function() {
    $('.delete-btn').on('click', function () {
        var deleteBtn = $(this);
        var id = deleteBtn.data('id'); // get id of data using this
        console.log(id);
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                url: '/tasks/' + id,
                method: "DELETE",
                success: function success(response) {
                    alert('Task Deleted Successfully..');
                    location.reload();
                },
                error: function error() {
                    alert("Error reaching the server. Check your connection");
                }
                });
            }
        });
    });

    $('.update-btn').on('click', function () {
        var updateBtn = $(this);
        var id = updateBtn.data('id'); // get id of data using this
        var text = updateBtn.attr('full-text'); // get text of data using this
        console.log(id);
    
        Swal.fire({
            title: 'Update Task',
            width: 1000,
            html: `<input type="text" style="width:700px;" id="swal-input1" class="swal2-input" value="${text}">`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then(function (result) {
            if (result.isConfirmed) {
                text = document.getElementById('swal-input1').value; 

                $.ajax({
                    url: '/tasks/' + id,
                    method: "PUT",
                    data:
                        {
                            'title' : text,
                        }
                    ,
                    success: function success(response) {
                        alert('Task UPDATED Successfully..');
                        location.reload();
                    },
                    error: function error() {
                        alert("Error reaching the server. Check your connection");
                    }
                });
            }
        });
    });
})