(function () {
    var doctor = {
        init: function() {
            this.cacheDom();
            this.bindEvents();
            this.render();
        },
        cacheDom: function() {
            this.$element = $('#bookings-requests_container');
        },
        bindEvents: function() {
            this.$element.find('.confirm-booking').on('click', this._bookSlot);
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
                text: "Do you want to create this booking!",
                icon: 'warning',
                confirmButtonText: 'Book!',
                showCancelButton: false,
                // cancelButtonText: 'No!',
                reverseButtons: false
            }).then((result) => {
                if (result.value) {

                    var status = $(e.target).attr('data-booking-status');
                    var id = $(e.target).attr('data-booking-id');
                    $.ajax({
                        url: $(e.target).attr('href'),
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'status': status, 'id': id},
                    })
                    .done(function(response) {
                        location.reload();
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
        _searchScheduals: function(e) {
            e.preventDefault();

            data = this;
            var date = $(e.target).find('.date').val();
            $.ajax({
                url: $(e.target).attr('action'),
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'date': date},
            })
            .done(function (response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'info',
                        text: response.error,
                      })
                } else {
                    data.$shedualContainer.fadeOut().html($(response)).fadeIn();
                }
            })
            .fail(function(xhr, status, errorThrown) {
                $.each(xhr.responseJSON.errors, function (key,value) {
                    toastr.error(value)
                });
            });
        }
    };
    doctor.init();
})();