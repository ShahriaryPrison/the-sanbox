* What concept were you trying to learn?
learning how a controller works backend codes
   * How does this code demonstrate it?
   app/Models/FakeSale.php: یک نسخه‌ی in-memory از مدل Sale که به‌جای دیتابیس واقعی، از یک آرایه‌ی seed شده استفاده می‌کنه. متد findOrFail رفتار Route Model Binding رو شبیه‌سازی می‌کنه و در صورت نبودن رکورد، Exception پرت می‌کنه (دقیقا همون اتفاقی که در لاراول واقعی منجر به 404 می‌شه).
   * What was your biggest "Aha!" moment or blocker?
   that generaly intersting 