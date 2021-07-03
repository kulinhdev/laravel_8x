<style>
    body {
        background-color: rgb(244 242 242);
    }
    .main {
        margin: 30px 0;
        text-align: center;
    }
    h1 {
        font-family: cursive;
        color: steelblue;
        font-size: 3.5em;
    }
    a {
        text-decoration: none;
        font-size: 30px;
        color: slateblue;
        font-family: cursive;
    } 
    a:hover {
        color: teal;
        transition: .3s ease-in-out;
    }
    .img {
        width: 40%;
        margin: 20px auto;
    } 
    img {
        width: 100%;
    }
</style>

<div class="main">
    <h1>This page not found 🐱‍🚀 :)) !</h1>
    <a href="{{ route('home') }}">Go to home page 🤪..!</a>
    <div class="img">
        <img src="{{ asset('images/image_404.jpg') }}" alt="Error">
    </div>
</div>


