import ReviewCard from './ReviewCard';

export default function ReviewList({ reviews }) {
    return (
        <div className="space-y-6">
            {reviews.map((review) => (
                <div key={review.id}>
                    <ReviewCard review={review} />
                </div>
            ))}
        </div>
    );
}
