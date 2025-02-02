import React from 'react';
import { Disclosure, Transition } from '@headlessui/react';
import { ChevronUpIcon } from '@heroicons/react/24/outline';
import type { FAQItem } from '@/types/models';

interface FAQSectionProps {
    questions: FAQItem[];
    title?: string;
}

export default function FAQSection({ questions, title = 'Frequently Asked Questions' }: FAQSectionProps) {
    return (
        <div className="w-full px-4 pt-16">
            <h2 className="text-2xl font-bold text-gray-900 mb-8">{title}</h2>
            <div className="mx-auto w-full max-w-2xl rounded-2xl bg-white p-2">
                {questions.map((faq, index) => (
                    <Disclosure key={index} as="div" className="mt-2">
                        {({ open }) => (
                            <>
                                <Disclosure.Button className="flex w-full justify-between rounded-lg bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus-visible:ring focus-visible:ring-gray-500 focus-visible:ring-opacity-75">
                                    <span>{faq.question}</span>
                                    <ChevronUpIcon
                                        className={`${
                                            open ? 'rotate-180 transform' : ''
                                        } h-5 w-5 text-gray-500`}
                                    />
                                </Disclosure.Button>
                                <Transition
                                    enter="transition duration-100 ease-out"
                                    enterFrom="transform scale-95 opacity-0"
                                    enterTo="transform scale-100 opacity-100"
                                    leave="transition duration-75 ease-out"
                                    leaveFrom="transform scale-100 opacity-100"
                                    leaveTo="transform scale-95 opacity-0"
                                >
                                    <Disclosure.Panel className="px-4 pt-4 pb-2 text-sm text-gray-500">
                                        {faq.answer}
                                    </Disclosure.Panel>
                                </Transition>
                            </>
                        )}
                    </Disclosure>
                ))}
            </div>
        </div>
    );
} 