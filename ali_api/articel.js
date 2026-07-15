fetch(
  "https://newsapi.org/v2/top-headlines?country=us&apiKey=d910f638684e413eb6d267613387acdb",
)
  .then((res) => res.json())
  .then((data) => {
    if (data.status === "error") {
      console.log("❌ Error:", data.code);
      return;
    }
    data.articles.forEach((article) => {
      console.log(article.title);
      console.log(article.source.name);
    });
  });
