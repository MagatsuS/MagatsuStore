<html>
<body>
    <form id="fpxForm" action="https://FPX_PAYMENT_URL" method="POST">
        @foreach($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button type="submit">Proceed to Payment</button>
    </form>

    <script>
        document.getElementById('fpxForm').submit();
    </script>
</body>
</html>
