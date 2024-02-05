import React,{useState, useEffect} from "react";
import './detailsSection.styles.css';
import BookDetailImg from "../../../assets/books-img/icebreaker.jpg"
import {baseUrl} from '../../../constants/Constants'
import Axios  from '../../../Axios';
import { useParams } from 'react-router-dom';

const DetailsSection = () => {
    const { id } = useParams();
    const [book, setBook] = useState(null);

    useEffect(() => {
        Axios.get(`${baseUrl}/api/get-book/${id}`)

            .then(response => {
                console.log(response);
                setBook(response.data.data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }, [id]);
    return(
        <section className="detials-section-container">
            <div className="container">
                <div className="flex-container">
                    <div className="book-img-container">
                    <img src={book ? baseUrl + book.image : 'placeholder_image_url'} alt="book" />
                    </div>
                    <div className="book-details-container">
                        <h2>{book ? book.name : "Loading..."}</h2>
                        <p className="text-primary author-name">{book ? book.author : "Loading..."}</p>
                        <p className="book-description">{book ? book.description : "Loading..."}</p>
                        <p><b>Language:</b>{book ? book.language : "Loading..."}</p>
                        <h3>{book ? `${book.price} AED` : "Loading..."} </h3>
                        <a href="#" className="button-primary">Add To Cart</a>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default DetailsSection;
