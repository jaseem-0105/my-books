import React, { useState } from "react";
import './footer.styles.css';
import Axios from '../../../Axios'
import {apiUrl, baseUrl} from '../../../constants/Constants'

const Footer = () => {
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        query: ''
    });

    const handleInputChange = (e) => {
        setFormData({
            ...formData,
            [e.target.id]: e.target.value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            await Axios.post(`${apiUrl}store-queries`, formData);
            console.log('Query submitted successfully!');
            setFormData({
                name: '',
                email: '',
                query: ''
            });
        } catch (error) {
            console.error('Error submitting query:', error);
        }
    };
    return (
        <section className="footer-container">
            <div className="container">
                <h2>If you have any queries feel free to ask here.</h2>

                <form className="footer-form" onSubmit={handleSubmit}>
                <div className="form-group">
                        <label htmlFor="name" className="form-label">Name:</label>
                        <input type="text" id="name" className="form-input" placeholder="Enter your name" onChange={handleInputChange} value={formData.name} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="email" className="form-label">Email:</label>
                        <input type="email" id="email" className="form-input" placeholder="Enter your email" onChange={handleInputChange} value={formData.email} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="query" className="form-label">Query:</label>
                        <textarea className="form-input" id="query" placeholder="Type your query" onChange={handleInputChange} value={formData.query}></textarea>
                    </div>
                    <div className="form-group">
                        <button type="submit" className="form-submit">Submit</button>
                    </div>
                </form>
                <p> &copy; 2024 MyBooks. All Rights Reserved.</p>
            </div>
        </section>
    )
}

export default Footer;
