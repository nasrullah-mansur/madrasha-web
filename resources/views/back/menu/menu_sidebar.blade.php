


@include('back.menu.custom_item')

@push('menu_js')
    <script>
        // Add Item from active select item;
        $(".add-item-to-menu").on("click", function () {
            let ddList = $(".dd-list").first();
            let getLiSelect = $(this).parents("ul").first().children("li.active").find("label");
            Array.from(getLiSelect).forEach(function (item) {
                let setData = {
                    liLabel: item.getAttribute("data-label"),
                    liUrl: item.getAttribute("data-slug"),
                    liMenuId: item.getAttribute("data-menu-id"),

                    liClass: item.getAttribute("data-class") ? item.getAttribute("data-class") : null,
                    liPosition: item.getAttribute("data-position") ? item.getAttribute("data-position") : null,
                    liTarget: item.getAttribute("data-target") ? item.getAttribute("data-target") : null,
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('menuItem.addItem') }}",
                    data: setData,
                    success: function (data) {
                        toastr.success("Menu item successfully added!", "WELL DONE");
                        $('#list-area').load(' #list-area', function() {
                            autoPosition();
                        });
                    },
                    error: function (error) {
                        if (error.statusText) {
                            toastr.warning("Something wrong! please reload the page", "Sorry");
                        }
                    },
                });
            });
        });
    </script>
@endpush