<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>اختبار لوحة الإدارة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">اختبار لوحة الإدارة</h1>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    لوحة الإدارة تعمل بنجاح!
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>الروابط:</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">لوحة الإدارة الرئيسية</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('admin.maids.index') }}" class="btn btn-info">إدارة الخادمات</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('admin.maids.create') }}" class="btn btn-success">إضافة خادمة جديدة</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('welcome') }}" class="btn btn-secondary">العودة للصفحة الرئيسية</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
