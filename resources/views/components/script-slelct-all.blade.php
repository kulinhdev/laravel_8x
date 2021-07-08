<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $("#select-all").click(function (event) {
        if (this.checked) {
            $(":checkbox").each(function () {
            this.checked = true;
        });
        } else {
            $(":checkbox").each(function () {
            this.checked = false;
        });
        }
    });
});
</script>