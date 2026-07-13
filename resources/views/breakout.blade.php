{{-- resources/views/checkout/breakout.blade.php --}}
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body>
<script>
    var target = "{{ $redirectTo }}";
    if (window.top !== window.self) {
        window.top.location.href = target;
    } else {
        window.location.href = target;
    }
</script>
</body>
</html>