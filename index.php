<?php
/*
نوشته شده توسط : @devbc
اپن شده در کانال : @zitactm
اشتراک گذاری با ذکر منبع مجاز است ‌.
*/
#-----------------------------#
date_default_timezone_set('Asia/Tehran');
error_reporting(0);
#-----------------------------#
$token = "7070934557:AAF7if8m9n8GRdgnLTHxu9LSZ6tkNM9ILiY"; //Token
$dev = "6782280182"; //Id Admin
#-----------------------------#
define('API_KEY', $token);
#-----------------------------#
$update = json_decode(file_get_contents("php://input"));
if(isset($update->message)){
    $from_id    = $update->message->from->id;
    $chat_id    = $update->message->chat->id;
    $tc         = $update->message->chat->type;
    $text       = $update->message->text;
    $first_name = $update->message->from->first_name;
    $message_id = $update->message->message_id;
}elseif(isset($update->callback_query)){
    $chat_id    = $update->callback_query->message->chat->id;
    $data       = $update->callback_query->data;
    $query_id   = $update->callback_query->id;
    $message_id = $update->callback_query->message->message_id;
    $in_text    = $update->callback_query->message->text;
    $from_id    = $update->callback_query->from->id;
}
#-----------------------------#
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
#-----------------------------#
function sendmessage($chat_id,$text,$keyboard = null) {
    bot('sendMessage',[
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "HTML",
        'disable_web_page_preview' => true,
        'reply_markup' => $keyboard
    ]);
}
#-----------------------------#
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}
#-----------------------------#
if(!is_dir("data")){
mkdir("data");
}
if(!is_dir("data/user")){
mkdir("data/user");
}
if(!is_dir("data/vpn")){
mkdir("data/vpn");
}
if(!is_dir("data/vpn/v2ray")){
mkdir("data/vpn/v2ray");
}
if(!is_dir("data/vpn/ex")){
mkdir("data/vpn/ex");
}
if(!is_dir("data/user/$from_id")){
mkdir("data/user/$from_id");
}
if(!is_dir("data/user/$from_id/vpn")){
mkdir("data/user/$from_id/vpn");
}
if(!is_dir("data/user/$from_id/vpn/v2ray")){
mkdir("data/user/$from_id/vpn/v2ray");
}
if(!is_dir("data/user/$from_id/vpn/ex")){
mkdir("data/user/$from_id/vpn/ex");
}
if(!file_exists("data/user/$from_id/coin")){
file_put_contents("data/user/$from_id/coin", "10000");
}
if(!file_exists("data/helpcont")){
    file_put_contents("data/helpcont", "😑متن راهنما تنظیم نشده است !");
}
if(!file_exists("data/ex")){
    file_put_contents("data/ex", "0");
}
if(!file_exists("data/v2ray")){
    file_put_contents("data/v2ray", "0");
}
#-----------------------------#
$step = file_get_contents ("data/user/$from_id/step.txt");
$coin = file_get_contents ("data/user/$from_id/coin");
$helpcont = file_get_contents ("data/helpcont");
$cart = file_get_contents ("data/cart");
$o = "🔘 بازگشت";
$oo = "🔘 برگشت";
#-----------------------------#
$ex = file_get_contents ("data/ex");
$v2ray = file_get_contents ("data/v2ray");
#-----------------------------#
$key1 = json_encode(['keyboard'=>[
[['text'=>"🔮 خرید فیلترشکن"]],
[['text'=>"💫 اطلاعات کاربری"],['text'=>"⚜ وضعیت سرویس ها"]],
[['text'=>"💡 آموزش اتصال"],['text'=>"➕ افزایش موجودی"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$key2 = json_encode(['keyboard'=>[
[['text'=>"📌 اکسپرس وی پی ان"],['text'=>"📌 کانفیگ وی پی ان"]],
[['text'=>"$o"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$back = json_encode(['keyboard'=>[
[['text'=>"$o"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$key3 = json_encode(['keyboard'=>[
[['text'=>"➕ افزودن وی پی ان"]],
[['text'=>"🔑 خدمات ارسال"],['text'=>"❌ حذف کل اکانتها"]],
[['text'=>"ℹ سایر خدمات"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$key4 = json_encode(['keyboard'=>[
[['text'=>"افزودن اکسپرس"],['text'=>"افزودن کانفیگ"]],
[['text'=>"$oo"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$bk = json_encode(['keyboard'=>[
[['text'=>"$oo"]],
],
'input_field_placeholder'=>"ورژن ۱.۰.۰",
'resize_keyboard' =>true]);
$key5 = json_encode(['keyboard'=>[
[['text'=>"💳ثبت شماره کارت"],['text'=>"💰 تعیین قیمت"]],
[['text'=>"♧ تنظیم متن راهنمای اتصال"]],
[['text'=>"🎺 تنظیمات کانال"],['text'=>"$oo"]],
],'resize_keyboard' =>true]);
#-----------------------------#
#-----------------------------#
#-----------------------------#
if($text == "/start" || $text == $o){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
▪︎ سلام $first_name عزیز به ربات فروش وی پی ان ما خوش آمدی :
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "🔮 خرید فیلترشکن"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ لطفا سرویس مورد نظرتون رو انتخاب کنید :

💳 قیمت کانفیگ وی پی ان  : $v2ray
💳 قیمت اکسپرس وی پی ان : $ex
",
'reply_markup'=>$key2,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "⚜ وضعیت سرویس ها"){
$scan = scandir ("data/vpn/v2ray");
$tv2ray = count ($scan) - 2;
$scan1 = scandir ("data/vpn/ex");
$tex = count ($scan1) - 2;
$keyom = json_encode(['inline_keyboard' => [
[['text' =>"تعداد سرویس های موجود",'callback_data'=>"a"],['text'=>"قیمت",'callback_data'=>"a"],['text' =>"نام سرویس",'callback_data'=>"a"]],
[['text' =>"$tex",'callback_data'=>"a"],['text'=>"$ex",'callback_data'=>"a"],['text' =>"اکسپرس",'callback_data'=>"a"]],
[['text' =>"$tv2ray",'callback_data'=>"a"],['text'=>"$v2ray",'callback_data'=>"a"],['text' =>"کانفیگ v2ray",'callback_data'=>"a"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🎴 وضعیت سرویس های وی پی ان و همچنین قیمت های آنها به شرح ذیل می باشد :",
'reply_markup'=>$keyom,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
elseif($text == "📌 کانفیگ وی پی ان"){
$scan = scandir ("data/vpn/v2ray");
$tv2ray = count ($scan) - 2;
if($coin < $v2ray){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "❌ متأسفانه موجودی شما جهت خرید این سرویس کافی نیست .",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
if($tv2ray < 1){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "متاسفانه تعداد اکانت های این سرویس به اتمام رسیده است . لطفا بعدا مراجعه کنید .",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
else{
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "لطفا کمی صبر کنید ربات درحال ساخت فیلتر شکن شما می باشد ...",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
sleep ('5');
$a = $coin - $v2ray;
file_put_contents ("data/user/$from_id/coin",$a);
$scan = scandir("data/vpn/v2ray");
$random = $scan[rand(2, count($scan) - 1)];
$a = file_get_contents ("data/vpn/v2ray/$random");
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ کانفیگ شما ساخته شد .
`$a`
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/vpn/v2ray/acc.v2ray","$a");
unlink ("data/vpn/v2ray/$random");
file_put_contents ("data/user/$from_id/step.txt","none");
}
}
#-----------------------------#
if($text == "📌 اکسپرس وی پی ان"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👍 فروش اکانت اکسپرس وی پی ان در اپدیت اینده اضافه می شود .",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💡 آموزش اتصال"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "$helpcont",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💫 اطلاعات کاربری"){
$scan = scandir ("data/user/$from_id/vpn/v2ray");
$scan1 = scandir ("data/user/$from_id/vpn/ex");
$v2raybuy = count ($scan) - 2;
$exbuy = count ($scan1) - 2;
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
📌 وضعیت کاربری شما در ربات ما :

🔢 شناسه عددی شما : `$chat_id`
💳 موجودی کل شما : *$coin تومان*
🔑 تعداد کانفیگ های خریداری شده : *$v2raybuy*
🎴 تعداد اکانت های اکسپرس خریداری شده : *$exbuy*
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "➕ افزایش موجودی"){
$rand  = rand (1,9);
$rand1 = rand (1,9);
$a = $rand + $rand1;
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
♻️ لطفا جهت احراز هویت حاصل جمع زیر را وارد کنید :
$rand + $rand1 = ?
",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/rand","$a");
file_put_contents ("data/user/$from_id/step.txt","rand");
}
elseif($step == "rand" and $text != $o){
$b = file_get_contents ("data/user/$from_id/rand");
if($text != $b){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "❌ حاصل وارد شده اشتباه است . لطفا دوباره تلاش کنید و از اعداد انگلیسی استفاده کنید .",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","rand");
}
else{
$keycart = json_encode(['inline_keyboard' => [
[['text' =>"ارسال رسید",'callback_data'=>"sendres"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ احراز هویت با موفقیت انجام شد.

💳 برای شارژ حساب خود ابتدا مبلغ مورد نظر خود را به کارت زیر واریز کنید سپس از طریق دکمه ارسال رسید ، رسید بانکی را ارسال کنید .

شماره کارت :
`$cart`

با کلیک روی شماره کارت به صورت خودکار برای شما کپی می شود .
",
'reply_markup'=>$keycart,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","card");
}
}
#-----------------------------#
if($data == "sendres"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ لطفا عکس رسید را برای من ارسال کنید :",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","zitactm");
}
elseif($step == "zitactm" and $text != $o){
$photo = $update->message->photo;
$file_id = $update->message->photo[count($update->message->photo) - 1]->file_id;
bot ('sendphoto',[
'chat_id'=>$dev,
'photo'=>"$file_id",
'caption'=>"
✅ فرستاده شده توسط کاربر `$chat_id`
",
'parse_mode'=>"Markdown",

]);
sendmessage ($chat_id,"رسید یا موفقیت ارسال شد ."  , $key1);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
#-----------------------------#
#-----------------------------#
elseif($from_id == $dev){
if($text == "/panel" || $text == $oo || $text == "پنل"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👍 سلام ادمین عزیز خوش آمدی :",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "➕ افزودن وی پی ان"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ یکی از سرویس های موجود را انتخاب کنید :",
'reply_markup'=>$key4,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "افزودن کانفیگ"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🔑 لطفا کد کانکشن کانفیگ v2ray را وارد کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","cratev2ray");
}
if($step == "cratev2ray" and $text != $oo){
$rand = rand (1000,100000);
file_put_contents ("data/vpn/v2ray/$rand",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅🔑 کانکشن v2ray با موفقیت ذخیره شد و برای فروش اماده شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "ℹ سایر خدمات"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🙂 لطفا یکی از دسته های موجود را انتخاب کنید :",
'reply_markup'=>$key5,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💳ثبت شماره کارت"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ شماره کارت خود را با اعداد انگلیسی وارد کنید :


شماره کارت فعلی : $cart
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","pooya");
}
if($step == "pooya" and $text != $oo){
file_put_contents ("data/cart",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👍 شماره کارت با موفقیت ثبت شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "♧ تنظیم متن راهنمای اتصال"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ متن راهنمای اتصال را وارد کنید : انگلیسی یا فارسی یا تلفیقی یا ... مشکلی ندارد .

متن فعلی : $helpcont
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","helpo");
}
if($step == "helpo" and $text != $oo){
file_put_contents ("data/helpcont",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ با موفقیت ثبت شد",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💰 تعیین قیمت"){
$moni = json_encode(['inline_keyboard' => [
[['text' =>"سرویس v2ray",'callback_data'=>"d1"]],
[['text' =>"سرویس اکسپرس",'callback_data'=>"d2"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🙂 قصد تغییر دادن قیمت کدام سرویس را دارید ؟",
'reply_markup'=>$moni,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($data == "d1"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
💳 قیمت مد نظرتون رو برای این سرویس با یک عدد انگلیسی و به تومان وارد کنید .
مثال : 5000

قیمت فعلی این سرویس : $v2ray
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","hala");
}
if($step == "hala" and $text != $oo){
file_put_contents ("data/v2ray",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "قیمت سرویس با موفقیت عوض شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($data == "d2"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
💳 قیمت مد نظرتون رو برای این سرویس با یک عدد انگلیسی و به تومان وارد کنید .
مثال : 5000

قیمت فعلی این سرویس : $ex
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","halaa");
}
if($step == "halaa" and $text != $oo){
file_put_contents ("data/ex",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "قیمت سرویس با موفقیت عوض شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "🎺 تنظیمات کانال"){
sendmessage ($chat_id , "اپدیت اینده اضافه می شود .");
}
if($text == "🔑 خدمات ارسال"){
sendmessage ($chat_id , "اپدیت اینده اضافه می شود .");
}
if($text == "افزودن اکسپرس"){
sendmessage ($chat_id , "اپدیت اینده اضافه می شود .");
}
#-----------------------------#
if($text == "❌ حذف کل اکانتها"){
DeleteDirectory ("data/vpn");
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ تمام اکانت های ثبت شده برای فروش از سرور ربات پاک شدند ‌.",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
} //
#-----------------------------#
#-----------------------------#
#-----------------------------#
/*
نوشته شده توسط : @devbc
اپن شده در کانال : @zitactm
اشتراک گذاری با ذکر منبع مجاز است ‌.
*/
?>