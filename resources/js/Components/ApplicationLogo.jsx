export default function ApplicationLogo(props) {
    return (
        <img 
            src="/storage/assets/pizza_kraken_favicon.png" 
            alt="Pizza Kraken Logo" 
            className="w-10 h-10" 
            width={100}
            height={100}
            {...props} 
            loading="lazy"
        />
    );
}
