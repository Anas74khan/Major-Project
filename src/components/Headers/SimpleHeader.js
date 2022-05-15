// nodejs library to set properties for components
import PropTypes from "prop-types";
// reactstrap components
import {
  Breadcrumb,
  BreadcrumbItem,
  Button,
  Container,
  Row,
  Col,
} from "reactstrap";

function TimelineHeader({ name, parentName }) {
  return (
    <>
      <div className="header header-dark pb-5">
        <Container fluid>
          <div className="header-body">
          <Row className="align-items-center py-3">
              <Col lg="9" xs="7">
                <h6 className="h4 text-dark d-inline-block mb-0">{name}</h6>{" "}
                <Breadcrumb
                  className="d-none d-md-inline-block ml-md-4"
                  listClassName="breadcrumb-links breadcrumb-dark"
                >
                  <BreadcrumbItem>
                    <a href="#pablo" onClick={(e) => e.preventDefault()}>
                      <i className="fas fa-home text-dark" />
                    </a>
                  </BreadcrumbItem>
                  <p className="text-dark px-1">/</p>
                  <BreadcrumbItem>
                    <a href="#pablo" onClick={(e) => e.preventDefault()} className="text-dark">
                      {parentName}
                    </a>
                  </BreadcrumbItem>
                  <p className="text-dark px-1">/</p>
                  <BreadcrumbItem aria-current="page" className="active text-dark">
                    {name}
                  </BreadcrumbItem>
                </Breadcrumb>
              </Col>
            </Row>
          </div>
        </Container>
      </div>
    </>
  );
}

TimelineHeader.propTypes = {
  name: PropTypes.string,
  parentName: PropTypes.string,
};

export default TimelineHeader;
