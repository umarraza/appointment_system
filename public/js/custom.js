(function () {
    var search = {
        init: function() {
            this.cacheDom();
            this.bindEvents();
            this.render();
        },
        cacheDom: function() {
            this.$element = $('#patientDashboard');
            this.$slotsContainer = $('#slots-section');
            this.$serachForm = this.$element.find('#search-doctor_form');
        },
        bindEvents: function() {
            this.$serachForm.on('submit', this._searchDoctors.bind(this));
            this.$slotsContainer.find('.book-slot').on('click', this._bookSlot);
        },
        render: function(response) {
            this.$element.find('#doctors-container').fadeOut().html($(response)).fadeIn();
        },

        _bookSlot: function(e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
              
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you want to book this slot!",
                icon: 'warning',
                confirmButtonText: 'Book!',
                showCancelButton: false,
                // cancelButtonText: 'No!',
                reverseButtons: false,
            }).then((result) => {
                if (result.value) {

                    Swal.fire(
                        'Your request is being processed... please wait!',
                    )

                    var start_time = $(e.target).text();
                    var doctor_id = $(e.target).attr('data-doctor-id');
                    var slot_id = $(e.target).attr('data-slot-id');
                    $.ajax({
                        url: $(e.target).attr('href'),
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'start_time': start_time, 'doctor_id': doctor_id, slot_id:slot_id},
                    })
                    .done(function(response) {
                        if (response.success) {
                            
                            Swal.fire(
                                'Request sent!',
                                response.success,
                                'success'
                            )
                            setTimeout(function(){location.reload()}, 5000);
                        } else {
                            Swal.fire(
                                'Oops!',
                                response.message,
                                'error'
                            )
                        }
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Booking cancled :)',
                    'error'
                    )
                }
            })
        },

        _searchDoctors: function(e) {
            e.preventDefault();

            $container = this;
            var formData = new FormData(this.$serachForm[0]);

            $.ajax({
                url: this.$serachForm.attr('action'),
                method: "POST",
                processData: false,
                contentType : false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
            })
            .done(function(response) {

                $container.render(response);
            })
            .fail(function(error) {
                $.each(error.responseJSON.errors, function (key,value) {
                    toastr.error(value)
                });
            });
        },
    };
    search.init();
})();