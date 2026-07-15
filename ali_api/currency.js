fetch(
  "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,dogecoin&vs_currencies=usd,eur",
)
  .then((res) => res.json())
  .then((data) => {
    // Check for the "empty object" bad-input case
    if (Object.keys(data).length === 0) {
      console.log("❌ No data found — check your coin ids.");
      return;
    }

    // Loop through each coin (e.g. "bitcoin", "ethereum", "dogecoin")
    for (const coin in data) {
      // Loop through each currency for that coin (e.g. "usd", "eur")
      for (const currency in data[coin]) {
        console.log(`${coin}: ${data[coin][currency]} ${currency}`);
      }
    }
  });
