@extends('layouts.fullwidth')
@section('title', 'سوالات متداول')
@section('insidebox')
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-dark" data-bs-toggle="collapse" href="#collapseOne">
                    کدام مرورگرها بهتر با تیکدز کار میکنند ؟
                </a>
            </div>
            <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                <div class="card-body">
                    تیکدز استفاده از مرورگر های گوگل کروم و موزیلا فایرفاکس را به شما پیشنهاد می کند
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed btn btn-dark" data-bs-toggle="collapse" href="#collapseTwo">
                    چگونه در سایت تیکدز عضو بشم؟
                </a>
            </div>
            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                <div class="card-body">
                    روی لینک عضویت در بالای صفحه کلیک کنید و عضو شوید
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a class="collapsed btn btn-dark" data-bs-toggle="collapse" href="#collapseThree">
                    در زمان خرید به دلیل ایجاد اختلال خرید ثبت نشد. چرا هنوز به حساب بر نگشته است؟
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                <div class="card-body">
                    در این صورت با توجه به ناموفق بودن تراکنش، مبلغ کم شده از حساب شما نهایتا تا ۷۲ ساعت از طرف بانک به حساب شما باز خواهد گشت، اگر پس از این مدت از عدم بازگشت وجه به حساب خود مطمئن بودید می‌توانید با  پشتیبانی سایت تماس حاصل فرمایید تا همکاران ما در اسرع وقت نسبت به حل مشکل شما اقدام نمایند.
                </div>
            </div>
        </div>
    </div>
@endsection
