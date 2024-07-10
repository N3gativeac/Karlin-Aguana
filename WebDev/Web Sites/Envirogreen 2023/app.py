from flask import Flask,  render_template, Blueprint, url_for, request, flash
#from flask_mysqldb import MySQL


app = Flask(__name__)
#app.secret_key + 'many ramdom bytes'

#app.config['MYSQL_HOST'] = 'localhost'
#app.config['MYSQL_USER'] = 'root'
#app.config['MYSQL_PASSWORD'] = 'EST@2024'
#app.config['MYSQL_DB'] = 'ESTDB'

#mysql = MySQL(app)

@app.route("/")
def home_page():
    return render_template("index.html")

@app.route("/about")
def about():
    return render_template("about.html")

@app.route("/techvocpage")
def techvocpage():
    return render_template("techvocpage.html")

@app.route("/shspage")
def shspage():
    return render_template("shspage.html")

@app.route("/collegepage")
def collegepage():
    return render_template("collegepage.html")


if __name__ == "__main__":
    app.run(debug=True)


