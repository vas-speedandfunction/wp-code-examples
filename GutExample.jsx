import React from 'react'
import icons from '../css/pe-icon-7-stroke.css'

const { wp } = window;
const { registerBlockType } = wp.blocks;
const { MediaUpload, RichText } = wp.blockEditor;
const { TextControl, Button, Modal } = wp.components;
const { withState } = wp.compose;
const { __ } = wp.i18n;

registerBlockType(
    'mirax/services-mirax-block',
    {
        title: __('Services'),
        category: 'mirax-blocks',
        icon: 'admin-generic',
        example: {
            attributes: {
                title: 'Services'
            }
        },
        attributes: {
            title: {
                type: 'string',
                source: 'attribute',
                attribute: 'data-title',
                selector: '.title'
            },
            items: {
                source: 'query',
                default: [],
                selector: '.animate',
                query: {
                    index: {
                        type: 'number',
                        source: 'attribute',
                        attribute: 'data-index',
                        selector: '.animate-more',
                    },
                    description: {
                        type: 'string',
                        source: 'text',
                        selector: '.animate-title',
                    },
                    url: {
                        type: 'string',
                        source: 'attribute',
                        attribute: 'href',
                        selector: '.animate-title',
                    },
                    icon: {
                        type: 'string',
                        source: 'attribute',
                        attribute: 'data-icon',
                        selector: '.animate-more',
                        default: 'pe-7s-star',
                    },
                    image: {
                        type: 'string',
                        source: 'attribute',
                        attribute: 'data-image',
                        selector: '.animate-img__in',
                    },
                }
            }
        },
        edit: (props) => {
            const { setAttributes, attributes } = props;
            const Dash = (props) => {
                let iconsList = [];
                let hashList = [];

                Object.keys(props.list).map((key) => {//Get hashlist of css classes
                    hashList.push(props.list[key]);
                });

                hashList.forEach((element, i) => {//Create array of elements for render
                    iconsList.push(
                        <div className={element} key={i}
                            onClick={props.onClick}>
                        </div>
                    );
                });

                return (
                    <div class="block-services-style-admin-icon">
                        {iconsList}
                    </div>
                )
            }
            const DashIcon = (props) => {

                return (
                    <div className="block-services-style-admin-icon">
                        <div className={props.value} onClick={props.onClick}></div>
                    </div>
                )
            }
            const MyModal = withState({
                isOpen: false,
            })((props) => {
                const { setState } = props;

                return (
                    <div className="block-services-style-admin-select-wrap">
                        <DashIcon
                            value={attributes.items[props.index].icon} //items.icon
                            onClick={() => setState({ isOpen: true })}
                        />
                        <div className="block-services-style-admin-select">Select icon</div>
                        {props.isOpen && (
                            <Modal
                                title="Select icon"
                                onRequestClose={() => setState({ isOpen: false })}
                                className="block-services-style-admin-modal"
                            >
                                <Dash list={icons} onClick={props.onClick} />
                            </Modal>
                        )}
                    </div>
                )
            }
            )
            const itemList = attributes.items.sort((a, b) => {
                return a.index - b.index;
            }).map((item) => {
                return (
                    <div className="block-services-style-admin-wrap" key={item.index}>
                        <div className="block-services-style-admin-info">
                            <TextControl
                                value={item.description}
                                label='Enter description text'
                                onChange={(value) => {
                                    var newObject = Object.assign({}, item, {
                                        description: value
                                    });
                                    return setAttributes({
                                        items: [].concat(_cloneArray(attributes.items.filter((itemFilter) => {
                                            return itemFilter.index != item.index;
                                        })), [newObject])
                                    });
                                }}
                            />
                            <TextControl
                                value={item.url}
                                label='Enter description link'
                                onChange={(value) => {
                                    var newObject = Object.assign({}, item, {
                                        url: value
                                    });
                                    return setAttributes({
                                        items: [].concat(_cloneArray(attributes.items.filter((itemFilter) => {
                                            return itemFilter.index != item.index;
                                        })), [newObject])
                                    });
                                }}
                            />
                            <MyModal
                                value={item.icon}
                                index={item.index}
                                onClick={(value) => {
                                    var newObject = Object.assign({}, item, {
                                        icon: value.target.className
                                    });
                                    return setAttributes({
                                        items: [].concat(_cloneArray(attributes.items.filter((itemFilter) => {
                                            return itemFilter.index != item.index;
                                        })), [newObject])
                                    });
                                }
                                }
                            />
                        </div>
                        <div className="block-services-style-admin-wrap-image">
                            <MediaUpload
                                title='Load image'
                                onSelect={(media) => {
                                    var newObject = Object.assign({}, item, {
                                        image: media.url
                                    });
                                    return setAttributes({
                                        items: [].concat(_cloneArray(attributes.items.filter((itemFilter) => {
                                            return itemFilter.index != item.index;
                                        })), [newObject])
                                    });
                                }
                                }
                                allowedTypes='image'
                                value={attributes.image}
                                render={({ open }) => (
                                    (!item.image) ? <Button className="block-services-style-admin-image-btn" onClick={open}>Open Media Library</Button> : <img src={item.image} onClick={open} className="block-services-style-admin-image" alt='block image' />
                                )}
                            />
                        </div>
                        <Button
                            className="block-services-style-admin-btn-remove"
                            onClick={() => {
                                let newObject = _cloneArray(attributes.items)

                                newObject.splice(item.index, 1)
                                newObject.forEach((element, index) => {
                                    if (element.index > index) {
                                        element.index--
                                    }
                                });

                                return setAttributes({
                                    items: newObject
                                })
                            }}
                        >+</Button>
                    </div>
                )
            });
            function _cloneArray(arr) {
                if (Array.isArray(arr)) {
                    for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
                        arr2[i] = arr[i];
                    }
                    return arr2;
                } else {
                    return Array.from(arr);
                }
            }
            return (
                <div className="block-services-style-admin">
                    <RichText
                        className="block-services-style-admin-title"
                        tagName='div'
                        placeholder='Here the title goes...'
                        value={attributes.title}
                        autoFocus={true}
                        onChange={(value) => {
                            setAttributes({
                                title: value
                            });
                        }}
                    />
                    <div className='item-list'>
                        {itemList}
                    </div>
                    <Button
                        className="block-services-style-admin-btn-add"
                        onClick={() => {
                            return setAttributes({
                                items: [].concat(_cloneArray(attributes.items), [{
                                    index: attributes.items.length,
                                    description: "",
                                    url: "",
                                    icon: "pe-7s-star", //This class must be not in icons class object, in another for example index.scss or other non hash classes file
                                    image: "",
                                }])
                            });
                        }}
                    >+</Button>
                </div>
            )
        },

        save: (props) => {
            const { attributes } = props;
            if (attributes.items.length > 0) {
                const itemList = attributes.items.map((item) => {
                    return (
                        <li className="block" key={ item.index }>
                            <div className="icon"><i className={item.icon}></i></div>
                        </li>
                    )
                });

                const itemList2 = attributes.items.map((item) => {
                    const title = item.url !== undefined ? <a className="animate-title" href={item.url}>{item.description}</a> : <div className="animate-title">{item.description}</div>
                    return (
                        <div className="animate" key={ item.index }>
                            <div className="animate-img">
                                <div className="animate-img__in" data-image={item.image}></div>
                                <div className='animate-more ' data-index={item.index} data-icon={item.icon}>
                                    {title}
                                </div>
                            </div>
                        </div>

                    )
                });

                return (
                    <section className="services circle" id="services">
                        <div className="container__in">
                            <div className="title wow fadeInUp" data-wow-delay=".2s" data-title={ attributes.title }>
                                <RichText.Content value={ attributes.title } />
                            </div>
                            <div className="circle--slider">
                                <ul className="circle--rotate" id="circle--rotate">
                                    {itemList}
                                </ul>
                                <div className="animate-wrapper wow pulse" data-wow-delay=".2s">
                                    {itemList2}
                                </div>
                                <div class="prev"><i class="left"><span></span><span></span></i></div>
                                <div class="next"><i class="right"><span></span><span></span></i></div>
                            </div>
                        </div>
                    </section>
                )
            } else {
                return null;
            }
        }

    }
);
