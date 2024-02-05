import React from "react";
import './signup.styles.css';
import AuthBgImg from '../../assets/auth-bg1.jpg'
import Navbar from "../../components/layouts/navbar/Navbar";
import AuthForm from "../../components/forms/auth-form/AuthForm";

const Signup = () => {
    return(
        <React.Fragment>
            <Navbar darkText={true}/>
            <section className="signup-container">
                <div className="signup-img-container">
                    <img src={AuthBgImg} alt="authantication-bgimg"/>
                </div>
                <div className="signup-content-container">
                    <div className="container">
                    <div className="content-wrapper">
                    <h2>Signup</h2>
                    <p>Create a new account</p>
                        <AuthForm buttonName="Signup" userName/>
                    </div>
                    </div>

                </div>

            </section>
        </React.Fragment>
    )
}
export default Signup;
