import ReviewCard from './ReviewCard';

export default function ReviewList({ reviews }) {
    return (
        <div>
            {reviews.map(review => <ReviewCard key={review.id} review={review} />)}
        </div>
    );
}
