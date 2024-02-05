import React, { useEffect, useState } from "react";
import AuthBgImg from "../../assets/auth-bg1.jpg";
import Navbar from "../../components/layouts/navbar/Navbar";
import AuthForm from "../../components/forms/auth-form/AuthForm";
import { useDispatch, useSelector } from "react-redux";
import { Link, useNavigate } from "react-router-dom";
import Loading from "../../components/layouts/loading/Loading";
import { login } from "../../redux/user/userSlice";

const Login = () => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const user = useSelector((state) => state.user.user);
    const auth_loading = useSelector((state) => state.user.auth_loading);
    const [email, setemail] = useState("");
    const [password, setPassword] = useState("");
    const [errors, setErrors] = useState({});
    const [authError, setAuthError] = useState(false);
    const [inputPasswordType, setInputPasswordType] = useState("password");
    const validateForm = () => {
        let isValid = true;
        let errors = {};

        if (!email) {
            isValid = false;
            errors.email = "Email is required";
        }
        // Add more validation logic here as needed

        if (!password) {
            isValid = false;
            errors.password = "Password is required";
        }

        setErrors(errors);
        return isValid;
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        if (validateForm()) {
             dispatch(login({ email: email, password: password }));
            // Form is valid, proceed with form submission
            // Replace this comment with your form submission logic
            console.log("Form Submitted:", { email, password });
        }
    };

    useEffect(() => {
        if (user?.success) {
            navigate("/", { replace: true });
        }
        if (user && !user?.success) {
            setAuthError(true);
        }
    }, [user]);

    return (
        <React.Fragment>
            {" "}
            {auth_loading ? (
                <Loading />
            ) : (
                <>
                    <Navbar darkText={true} />
                    <section className="signup-container">
                        <div className="signup-img-container">
                            <img src={AuthBgImg} alt="authantication-bgimg" />
                        </div>
                        <div className="signup-content-container">
                            <div className="container">
                                <div className="content-wrapper">
                                    <h2>Login</h2>
                                    <form onSubmit={handleSubmit}>
                                        <div className="form-group">
                                            <label>Email</label>
                                            <input
                                                type="email"
                                                onChange={(e) => setemail(e.target.value)}
                                                className="form-input "
                                                placeholder="Enter your email"
                                            />
                                            {errors.email && (
                                                <div className="error">
                                                    {errors.email}
                                                </div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <label>Password</label>
                                            <input
                                                type="password"
                                                onChange={(e) => setPassword(e.target.value)}

                                                className="form-input "
                                                placeholder="Enter your password"
                                            />
                                            {errors.password && (
                                                <div className="error">
                                                    {errors.password}
                                                </div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <input
                                                type="submit"
                                                className="button-primary"
                                                value={"Login"}
                                            />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </>
            )}
        </React.Fragment>
    );
};
export default Login;
